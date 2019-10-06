<?php

namespace oniyow\Http\Controllers;

use Illuminate\Http\Request;
use oniyow\Http\Requests\ValidaCreaDatoFiscal;
use oniyow\Model\Datofiscal;
use oniyow\Model\Factura;
use oniyow\Model\Cliente;
use oniyow\Events\eventMailFactura;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Exception;

class ControlDatoFiscal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accion = 4;//Agregar DatoFiscal Admin
        $idVenta = 0;//Prueba;
        $cliente = auth() -> user();
        return  view("venta.datosFiscales", compact("cliente", "idVenta", "accion"));

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
    public function store(ValidaCreaDatoFiscal $r)
    {
        //dd($request -> all());
        $datoFiscal = Datofiscal::create([
            "cliente" =>  auth() -> user() -> dato,
            "RFC" =>  $r -> input("rfc"),
            "calle" => $r -> input("calle"),
            "numinterior" => $r -> input("ninterior"),
            "numexterior" => $r -> input("nexterior"),
            "colonia" => $r -> input("colonia"),
            "cp" => $r -> input("cp"),
            "municipio" => $r -> input("municipio"),
            "estado" => $r -> input("estado"),
        ]);
        if($r -> input("accion") == 4){

            $e = ($datoFiscal) ? "ok-create-datoFiscal-Admin":"error-create-datoFiscal-Admin";
            $admin = auth() -> user();

            return view("Configuracion.Admin.index", compact("admin", "e"));
        }
        if($datoFiscal){
            $idVenta = $r -> input("idVenta");
            $accion = $r -> input("accion");
            //Consultar si existe la factura de esa venta si no crearla luego verificar la accion para enviar o impimir el PDF
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
                $admin = Cliente::with("datoFiscal") -> where("tipo", "=" , "admin") -> get()[0];
                $idEmail = $r -> input("emails");
                //dd($admin);
                switch($accion){
                    case 0://PDF y correo
                        foreach (auth() -> user() -> datoC -> emails as $email){
                            if($email -> id == $idEmail){
                                // dd($email -> email);
                                $msj = "Si existe";
                                $ev = new eventMailFactura($email -> email, $factura, $admin);
                                event($ev);
                                break;
                            }
                        }
                        //dd($admin);
                        $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
                        return $pdf -> stream('Factura.pdf');
                        break;
                    case 1://PDF
                        $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
                        return $pdf -> stream('Factura.pdf');
                        break;
                    case 2://Descargar
                        $pdf = PDF::loadView("factura.pdf", compact("factura", "admin"));
                        return $pdf -> download ('Factura.pdf');
                        break;
                    case 3://Enviar
                        foreach (auth() -> user() -> datoC -> emails as $email){
                            if($email -> id == $idEmail){
                                // dd($email -> email);
                                $msj = "Si existe";
                                $ev = new eventMailFactura($email -> email, $factura, $admin);
                                event($ev);
                                break;
                            }
                        }
                        return redirect(route("cliente.compras"));
                        break;
                }
            }

        }
        return redirect(route("cliente.compras"));
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
}
