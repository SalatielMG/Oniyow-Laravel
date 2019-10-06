<?php

namespace oniyow\Http\Controllers;

use Illuminate\Http\Request;
use oniyow\Model\Producto;

class ControlProductoREST extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Producto::all();
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
    public function store(Request $r)
    {
        $p = Producto::create([
            "nombre" => $r->input("nombre"),
            "descripcion" => $r->input("descripcion"),
            "stock" => $r->input("stock"),
            "precio" => $r->input("precio"),
            //"imagen" => ($r -> hasFile("imagen")) ? : null,
        ]);
        $msj = ["msj"=>"Se presento un error"];
        if($p){
            $msj = ["msj"=>"Producto insertado"];
        }
        return $msj;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $prod = Producto::findOrFail($id);
        }catch (Exception $e){
            $prod = array();
        }
        return $prod;
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
    public function update(Request $r, $id)
    {
        try{
            $p = Producto::findOrFail($id);
            $p -> nombre = $r -> input("nombre");
            $p -> descripcion = $r -> input("descripcion");
            $p -> stock = $r -> input("stock");
            $p -> precio = $r -> input("precio");
            $p -> save();
            $ms = ["msj" => "Producto Editado Correctamente"];
        }catch(Exception $e){
            $ms = ["msj" => "Se presento un error"];
        }
        return $ms;
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
            $p = Producto::findOrFail($id);
            $p -> delete();
            $ms = ["msj" => "Producto eliminado correctamente"];
        }catch(Exception $e){
            $ms = ["msj" => "Se presento un error"];
        }
        return $ms;
    }
}
