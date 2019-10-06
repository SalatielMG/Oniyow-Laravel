<?php

namespace oniyow\Http\Controllers;

use oniyow\Http\Requests\ValidaCreaProducto;
use oniyow\Http\Requests\ValidaEditaProducto;
use oniyow\Model\Producto;
use Illuminate\Http\Request;
use Exception;

class ControlProducto extends Controller
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
    public function index($e = "")
    {
        $productos = Producto::all();
        return view("productos.index", compact("productos", "e"));
        //return Producto::all();
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
    public function store(ValidaCreaProducto  $r)
    {
        //dd($r -> all());
        /*if($r -> hasFile("imagenP"))
            dd($r -> file('imagenP') -> store("public"));
        else
            dd($r);
            //dd($r -> file('imagenP') -> store("public"));*/
        try{
            Producto::create([
                "nombre" => $r -> input("nombre"),
                "descripcion" => $r -> input("descripcion"),
                "stock" => $r -> input("stock"),
                "precio" => $r -> input("precio"),
                "imagen" => ($r -> hasFile('imagenP')) ? $r -> file('imagenP') -> store("public") : null,
            ]);
            $e = "ok-create-producto";
        }catch(Exception $e){
            $e = "error-create-producto";
        }
        return $this -> index($e);
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
    public function update(ValidaEditaProducto $r, $id)
    {
        //sdd($r -> all());
        try{
            /*Producto::update([
                "nombre" => $r -> input("nombreE"),
                "descripcion" => $r -> input("descripcionE"),
                "stock" => $r -> input("stockE"),
                "precio" => $r -> input("precioE"),
                "imagen" => ($r -> hasFile('imagenPE')) ? $r -> file('imagenPE') -> store("public") : null,
            ]);*/
            $p = Producto::findOrFail($r->input("idP"));
            $p -> nombre = $r->input("nombreE");
            $p -> descripcion = $r->input("descripcionE");
            $p -> stock = $r->input("stockE");
            $p -> precio = $r->input("precioE");
            if($r -> hasFile("imagenPE"))
                $p -> imagen = $r -> file('imagenPE') -> store("public");
            $p -> save();
            $e = "ok-edit-producto";
        }catch(Exception $e){
            $e = "error-edit-producto";
        }
        return $this -> index($e);
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
            $cat = Producto::findOrFail($id);
            $cat -> delete();
            $e = "ok-delete-producto";
        }catch(Exception $e){
            $e = "error-delete-producto";
        }
        return $this -> index($e);
    }
}
