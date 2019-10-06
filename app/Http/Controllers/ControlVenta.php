<?php

namespace oniyow\Http\Controllers;

use oniyow\Events\eventMailCompra;
use oniyow\Events\eventMailFactura;
use oniyow\Model\Cliente;
use oniyow\Model\Datofiscal;
use oniyow\Model\Factura;
use oniyow\Model\Producto;
use oniyow\Model\Promocion;
use oniyow\Model\Venta;
use Illuminate\Http\Request;
use DB;
use Exception;
use DateTime;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
//use PDF;

class ControlVenta extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        //parent::__construct();
        $this->middleware("auth");
    }

    public function index()
    {
        //session( ["venta"=>[] ] );

        return view("venta.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        try{
            $carrito = session("compras");

            $lista = [];
            $msjCantidadError = "";
            foreach($carrito as $c){
                $p = Producto::findOrFail($c["id"]);
                if($p->stock >= $c["cantidad"])
                    $lista[] = ["producto" => $c["id"], "promocion" => $c["promocion"], "precio" => $c["precio"], "cantidad" => $c["cantidad"], "porcentaje" => $c["porcentaje"]];
                else {
                    $msjCantidadError .= "La cantidad del producto $p->nombre no es suficiente.\n";
                    $respuesta = false;
                }
            }
            if(empty($msjCantidadError)){

                $venta = new Venta;
                $venta -> cliente = auth() -> user() -> dato;
                $venta -> save();
                $venta -> productos() -> attach($lista);
                session(["compras" => null]);
                //$ev = new compras(auth()->user(), $carrito);
                //event($ev);
                //$error .= $ev->error;
                //Falta trigger para disminuir la cantidad en productos
                $respuesta = true;

                //dd($venta -> clienteC -> datoC -> emails);
                $ev = new eventMailCompra($venta);
                event($ev);
                $msjCantidadError .= $ev -> error;

                //Envio de correos

            }

        }catch(Exception $e){
            $respuesta = false;
            $msjCantidadError = "No se pudo completar la compra :( $e";
        }
        return ["respuesta" => $respuesta,"msj" => $msjCantidadError];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function productosAjax(Request $r){
        $buscar = trim($r -> input("buscar"));
        $fechaActual = new DateTime("now");

        $promociones = Promocion::where([
            ["fehcainicio", "<=", $fechaActual],
            ["fechafinal", ">=", $fechaActual],
        ]) -> get();

        $prods = array();
        $prods["promocion"] = $promociones;
        $sqlFull = "SELECT * FROM producto  WHERE nombre LIKE '%$buscar%'";


        //dd($promociones);



        if(count($promociones) > 0){
            $where = "";
            //  dd($promociones);
            foreach ($promociones as $p) {


                $sql = "SELECT pd.id FROM promocion_producto as pp, producto as pd
                where pp.promocion = $p->id AND pp.producto = pd.id AND pd.nombre LIKE '%$buscar%'";

                $array = DB::select($sql);
                $prod = array();
                foreach($array as $o) array_push($prod, $o -> id);
                $p["pp"] = $prod;

                if($promociones -> last() == $p)
                    $where = $where . "pm.id = $p->id";
                else{
                    $where = $where . "pm.id = $p->id || ";
                }

            }
            //dd($where);
            $sqlFull = $sqlFull . " AND id NOT IN (SELECT pp.producto FROM promocion_producto as pp, promocion as pm, producto as pd 
                WHERE pp.promocion = pm.id AND ($where) AND pp.producto = pd.id AND pd.nombre LIKE '%$buscar%')";
            //dd($sqlFull);
        }
        $prods["productos"] = DB::select($sqlFull);
        return view("venta.productos",compact("prods"));
    }

    public function carrito(Request $r){
        $producto = $r -> input("id");
        $p = Producto::find($producto);
        $promocion = $r -> input("idPromocion");
        if($promocion != null){
            $porcentaje = DB::select("SELECT porcentaje from promocion_producto where promocion = $promocion and producto = $producto");
            //$precioDescuento = $p -> precio - (($porcentaje[0] -> porcentaje * $p -> precio) / 100);
        }

        $t = $this -> tablaCompras(
            $p -> id,
            $r -> input("cantidad"),
            $p -> nombre,
            $p -> precio,
            $p -> stock,
            ($promocion != null) ? $r -> input("idPromocion") : 0,
            ($promocion != null) ? $porcentaje[0] -> porcentaje: 0
        );
        if($t){
            $json["ok"] = true;
        }else{
            $json["ok"] = false;
            $json["msj"] = "La cantidad de producto en existencia es $p->stock";
        }
        $json["cant"] = count(session("compras"));
        return $json;
    }

    private function tablaCompras($id, $cantidad, $nombre, $precio, $stock, $idPromocion, $porcentaje){
        if(empty(session("compras")))
            session( ["compras" => [] ] );
        $tabla = session("compras");

        if(array_key_exists($id, $tabla)){
            $tabla[$id]["cantidad"] +=  $cantidad;
        }else
            $tabla[$id] = ["id" => $id, "cantidad" => $cantidad, "nombre" => $nombre, "precio" => $precio, "promocion" => $idPromocion, "porcentaje" => $porcentaje];

        if($tabla[$id]["cantidad"] <= $stock){
            session(["compras" => $tabla]);
            return true;
        }
        return false;
    }

    public function listaCarrito(){
        $carrito = session("compras");
        return view("venta.indexCarrito",compact("carrito"));
    }


    public function eliminarProdCarrito($id){
        $carrito = session("compras");
        unset($carrito[$id]); //Para destruir elementos enn PHP
        session(["compras"=>$carrito]);
    }

    public function cancelarCompra(){
        session(["compras"=>[]]);
        if( count(session("compras")) == 0)
            return ["r"=>true];
        return ["r"=>false];
    }

    public function verComprasCliente(){
        //$v->cliente = auth()->user()->dato;
        //$id = 3; //Aqui va el cliente autenticado
        $ventas = Venta::with("productos")->where("cliente",auth()->user()->dato)->orderBy("created_at","DESC")->get();

        return view("venta.historialCompras",compact("ventas"));
    }

    public function verificarDF(Request $r)
    {
        //dd($r -> all());
        $idVenta = $r -> input("idVenta");
        $accion = $r -> input("accion");
        $cliente = auth() -> user();
        $encontrado = Datofiscal::find($cliente -> dato);
        if (empty($encontrado)) {
            //view("venta.datosFiscales", compact("cliente", "idVenta"));
            return  view("venta.datosFiscales", compact("cliente", "idVenta", "accion"));

        }else{
            if($accion == 0 || $accion == 3){
                if(empty(auth() -> user() -> datoC -> emails)){
                    return  view("venta.datosFiscales", compact("cliente", "idVenta"));
                }else
                    return ["bnd" => true, "emails" => auth() -> user() -> datoC -> emails, "idVenta" => $idVenta, "accion" => $accion];
            }
            //$array = array();
            //$facturas = Factura::where(["venta", "=", $idVenta]) -> get();
            $factura = Factura::with("ventaF") -> where("venta", "=", $idVenta) -> get();
            //$facturas = DB::select("select * from factura where venta = $idVenta")
            if(!empty($factura -> all())){
                //dd($facturas -> all());
                $factura = $factura[0];
            }else{
                try{
                    $factura = Factura::create([
                        "venta" => $idVenta,
                    ]);
                }catch(Exception $e){
                    return redirect(route("cliente.compras"));
                    //return view("venta.historialCompras", compact("e"));
                }
            }
            $admin = Cliente::with("datoFiscal") -> where("tipo", "=" , "admin") -> get()[0];

            if($accion == 1) {
                $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
                return $pdf -> stream('Factura.pdf');
            }else if($accion == 2){
                $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
                return $pdf -> download ('Factura.pdf');
            }
        }
    }

    public function facturar(Request $r){
        //dd($r -> all());
        $idVenta = $r -> input("idVenta");
        $accion = $r -> input("accion");
        $idEmail = $r -> input("emails");

        //Revisar si la venta ya tiene factura. Facturar o
        $factura = Factura::with("ventaF") -> where("venta", "=", $idVenta) -> get();

        //  $factura = Factura::where(["venta", "=", $idVenta]) -> get();
        if(empty($factura -> all())){
            //Facturar
            $factura = Factura::create([
                "venta" => $idVenta,
            ]);
        }else $factura = $factura[0];

        //Enviar la factura al correo.
        $msj = "No existe";
        $admin = Cliente::with("datoFiscal") -> where("tipo", "=" , "admin") -> get()[0];

        foreach (auth() -> user() -> datoC -> emails as $email){
            if($email -> id == $idEmail){
                // dd($email -> email);
                $msj = "Si existe";
                $ev = new eventMailFactura($email -> email, $factura, $admin);
                event($ev);
                break;
            }
        }

        if($accion == 0) {
            $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
            return $pdf -> stream('Factura.pdf');
        }else{
            return redirect(route("cliente.compras"));
        }
    }

    public function pdf($accion, $factura){
        $factura = json_decode($factura);
        $admin = Cliente::with("datoFiscal") -> where("tipo", "=" , "admin") -> get()[0];
        if($accion == 1 || $accion == 0) {
            $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
            return $pdf -> stream('Factura.pdf');
        }else if($accion == 2){
            $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
            return $pdf -> download ('Factura.pdf');
        }
    }
    public function emailsAjax(){
        return auth() -> user() -> datoC -> emails;
    }
    public function telefonosAjax(){
        return auth() -> user() -> datoC -> telefonos;
    }

}
