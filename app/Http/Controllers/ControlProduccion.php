<?php

namespace oniyow\Http\Controllers;

use oniyow\Model\MetodoFabrica;

use oniyow\Model\Produccion;
use oniyow\Model\Producto;
use Illuminate\Http\Request;
use DB;
use Barryvdh\DomPDF\Facade as PDF;

class ControlProduccion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $titulo = "Produccion";
        //$productos = Producto::with("metodoraro","metodofabrica")->get();
        //return $productos;

        $productos =  Producto::all();
        return view("produccion.index",compact("titulo","productos"));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $productos = Producto::all();

        return view("produccion.create",compact("productos"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $producto = $r ->input("producto");
        $metodo = $r ->input("metodo");
        $cantidad = $r ->input("cantidad");

        $metodos = MetodoFabrica::where("producto","=","$producto")->find($metodo);

        $json["p"] = $producto;
        $json["m"] = $metodo;
        $json["c"] = $cantidad;
        $json["msj"] = "true";
        $posible[]="";
        if(!empty($metodos)){
            $json["msj"] = "true";
            $posible = $this->verificarPosibilidadProduccion($metodo,$cantidad);
            if($posible["result"]){
                $produccion = new Produccion();
                $produccion->cantidadfabricado = $cantidad;
                $produccion->metodo = $metodo;
                $produccion->save();
                toastr()->success('Exitosa', 'Produccion');
            }else{
                $msj= $posible["msj"];
                toastr()->warning("$msj", 'Produccion Fallida');
            }

        }else
            $json["msj"] = "No se encuentra el metodo";



        $titulo = "Produccion";
        $productos =  Producto::all();
        return $this->index();

    }


    public function verificarPosibilidadProduccion($metodofabrica,$cantidadProducir){
        $metodos = MetodoFabrica::with("materias")->find($metodofabrica);
        $sePuede = true;
        $msj = "";
        foreach ($metodos->materias as $materia){
            $mStock =  $materia->stock;
            $ocupa = $materia->pivot->cantidad;
            $cantNecesita = $ocupa * $cantidadProducir;
            if( $cantNecesita <=  $mStock){
                //$msj .= "La materia \"$materia->nombre\" necesita $cantNecesita unidades, cuenta con $mStock\n";
            }else{
                $msj .= "\"$materia->nombre\" necesita $cantNecesita unidades, cuenta con $mStock _____________";
                $sePuede = false;
            }

        }
        if(!$sePuede)
            $msj .= "No se puede realizar la produccion";
        else
            $msj .= "Produccion exitosa";

        $json["msj"] = $msj;
        $json["result"] = $sePuede;

        return $json;
    }

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
            $produccion = Produccion::find($id);
            $produccion->delete();
            $e = "ok-delete";
            toastr()->warning('Eliminado', 'Produccion');
        }catch(Exception $e){
            $produccion = null;
            $e = "error-delete";
        }
        return $e;

    }

    public function recarga(Request $r){

        $id = $r ->input("id");
        $metodos = MetodoFabrica::with("materias")->where("producto","=","$id")->get();
        //dd($metodos);
        $json["contar"] = count($metodos);
        $json["metodos"] = $metodos;
        return $json;
    }

    public function materiasOcupa(Request $r){
        $id = $r ->input("id");
        $materiasOcupa = MetodoFabrica::with("materias")->where("id","=","$id")->get();
        //$materiasOcupa = $materiasOcupa[0]->materias;

        return view("produccion.materiasEnOcupa", compact("materiasOcupa"));
    }


    public function pdfProduccion(){
        $productos =  Producto::all();

        $pdf = PDF::loadView("reportes/prueba",compact("productos"));
        $pdf->setPaper("letter","portrait");
        return $pdf->stream();
    }

    public function eliminar($id){
        return $id;
    }
}
