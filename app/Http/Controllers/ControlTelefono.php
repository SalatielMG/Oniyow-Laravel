<?php

namespace oniyow\Http\Controllers;

use Illuminate\Http\Request;
use oniyow\Model\Telefono;

class ControlTelefono extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try{
            $validar = $r -> validate(["telefononuevo" => "required|digits:10|unique:telefono,numero"]);
            Telefono::create([
                "dato" => auth() -> user() -> dato,
                "numero" => $r -> input("telefononuevo"),
            ]);
            return ["Error" => false, "telefonos" => auth() -> user() -> datoC -> telefonos];
        }catch(\Exception $e){
            return ["Error" => true, "msj" => "Error al registrar el nuevo numero, Intente ingresar un numro valido y que no exixte en la base de datos."];
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
        //
    }
}
