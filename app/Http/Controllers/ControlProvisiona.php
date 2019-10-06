<?php

namespace oniyow\Http\Controllers;

use oniyow\Model\MateriaPrima;
use oniyow\Model\Proveedor;
use oniyow\Model\Provisiona;
use Illuminate\Http\Request;
use Exception;
use DB;

class ControlProvisiona extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provisiona = Provisiona::with("materias")->orderBy("created_at","DESC")->get();
        //return $provisiona;
        return view("provisiona.historialCompras",compact("provisiona"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!empty(session("compraMaterias")))
            $compraMaterias = session("compraMaterias");

        $titulo = "Comprando al proveedor";
        $proveedores = Proveedor::with("datos")->get();
        //$materias = MateriaPrima::with("unidad")->get();
        return view("provisiona.index",compact("proveedores","compraMaterias","titulo"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        try{
            $compraMaterias = session("compraMaterias");
            $lista = [];
            foreach($compraMaterias as $c){
                $lista[] = ["materiaprima"=>$c["id"],"cantidad"=>$c["cantidad"],"precio"=>$c["precio"]];
            }

            $proveedor = $r->input("proveedor");
            $provisiona =  new Provisiona();
            $provisiona -> proveedor = $proveedor;
            $provisiona->save();


            $provisiona->materias()->attach($lista);

            session( ["compraMaterias"=>[] ] );
            toastr()->success('Exitosa','Compra al proveedor');
            return ["r"=>true];
        }catch (Exception $e){
            return ["r"=>false,"msj"=>'Error al procesar la compra'];

        }




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
        try{
            $provisiona= Provisiona::find($id);
            $provisiona->delete();
            $e = "ok-delete";
            toastr()->success('Eliminado', 'Provisiona');
        }catch(Exception $e){
            $provisiona = null;
            $e = "error-delete";
        }
        return $e;
    }



    public function materiaSearch(Request $r){

        $buscar = trim($r->input("buscar"));
        $sql = "SELECT m.*,u.medida FROM materiaprima as m,unidadmedida as u WHERE m.unidadmedida = u.id AND (nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%')";
        $materias = DB::select($sql);
        //dd($materias);
        return view("provisiona.materias",compact("materias"));
    }

    public function guardaMateria(Request $r){
        try{

            if(empty(session("compraMaterias")))
                session( ["compraMaterias"=>[] ] );

            $compraMaterias = session("compraMaterias");

            $cantidad = $r->input("cantidad");
            $precio = $r->input("precio");
            $m = MateriaPrima::find($r->input("id"));

            if(array_key_exists($m->id, $compraMaterias)){
                $compraMaterias[$m->id]["cantidad"] +=  $cantidad;
            }else
                $compraMaterias[$m->id] = ["id"=>$m->id,"cantidad"=>$cantidad,"precio"=>$precio,"nombre"=>$m->nombre];

            session(["compraMaterias"=>$compraMaterias]);

            //$json["ok"] = true;
            //$json["msj"] = "Materia guardada";
            //$json["cant"] = count(session("compraMaterias"));
            return view("provisiona.materiasComprar",compact("compraMaterias"));

        }catch(Exception $e){
            return null;
        }
    }

    public function eliminarMateriaProvisiona($id){
        $carrito = session("compraMaterias");
        unset($carrito[$id]); //Para destruir elementos enn PHP
        session(["compraMaterias"=>$carrito]);
    }

    public function cancelarProvisiona(){
        session(["compraMaterias"=>[]]);
        if( count(session("compraMaterias")) == 0)
            return ["r"=>true];
        return ["r"=>false];
    }

    public function verComprasProvisiona(){

    }
}
