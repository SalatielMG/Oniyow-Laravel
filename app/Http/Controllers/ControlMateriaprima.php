<?php

namespace oniyow\Http\Controllers;


use oniyow\Http\Requests\ValidaCreateMateria;
use oniyow\Model\MateriaPrima;
use oniyow\Model\Proveedor;
use oniyow\Model\Unidadmedida;
use Illuminate\Http\Request;
use Exception;
use DB;

class ControlMateriaprima extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($e = "")
    {
        $titulo = "Materia";
        $materias = MateriaPrima::with("unidad")->get();
        return view("materia.index",compact("materias","titulo"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidadmedida = Unidadmedida::all();
        return view("materia.create",compact("unidadmedida"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidaCreateMateria $r)
    {
        try{
            $m = new MateriaPrima();
            $m->nombre = $r->input("nombre");
            $m->descripcion = $r->input("descripcion");
            $m->stock = $r->input("stock");
            $m->unidadmedida = $r->input("unidadmedida");

            if($r->hasFile('imagen'))
                $m->imagen = $r->file('imagen')->store("public");



            $m->save();
            toastr()->success('Creado','Materia');
            $e = "ok-create";
        }catch(Exception $e){
            $e = "error-create";
        }


        return $this->index($e);
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
            $unidadmedida = Unidadmedida::all();
            $m = MateriaPrima::findOrFail($id);
        }catch(Exception $e){
            $m = null;
            $e = "error-show";
        }
        return view("materia.edit",compact("m","unidadmedida"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $e = "";
        try{
            $unidadmedida = Unidadmedida::all();
            $m = MateriaPrima::findOrFail($id);
        }catch(Exception $e){
            $m = null;
            $e = "error-show";
        }
        return view("materia.edit",compact("m","e","unidadmedida"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidaCreateMateria $r, $id)
    {
        try{
            $m = MateriaPrima::findOrFail($id);
            $m->nombre = $r->input("nombre");
            $m->descripcion = $r->input("descripcion");
            $m->stock = $r->input("stock");
            $m->unidadmedida = $r->input("unidadmedida");
            if($r->hasFile('imagen'))
                $m->imagen = $r->file('imagen')->store("public");

            $m->save();
            toastr()->info('Actualizadp','Materia');
            $e = "ok-update";
        }catch(Exception $e){
            $cat = null;
            $e = "error-update";
        }
        return $this->index($e);
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
            $m = MateriaPrima::findOrFail($id);
            $m->delete();
            toastr()->warning('Eliminado','Materia');
            $e = "ok-delete";
        }catch(Exception $e){
            $cat = null;
            $e = "error-delete";
        }
        return $this->index($e);
    }




}
