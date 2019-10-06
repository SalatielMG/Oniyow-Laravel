<?php

namespace oniyow\Http\Controllers;

use oniyow\Model\Ombeay;
use oniyow\Model\Unidadmedida;
use Illuminate\Http\Request;

class ControlUnidadmedida extends Controller
{

    public function index($e = "")
    {
        $titulo = "Unidades de Medida";
        $medida = Unidadmedida::all();
        return view("medida.index",compact("medida","e","titulo"));

    }


    public function create()
    {

        /*
        $file = fopen((asset('storage/Mamiferos.txt')), "r") or exit("Unable to open file!");
        //Output a line of the file until the end is reached
        $datos = array();
        //$datos = "";
        $i = 1;
        while(!feof($file)) {
            $linea = utf8_encode(fgets($file));
            //$linea = trim( $linea );
            $linea = preg_replace("/[\r\n|\n|\r|\t]+/", "", $linea);
            if($linea != ""){
                $parte =  explode("#",$linea);
                $pos =  array( "huave" => $parte[0] ,
                    "espanol" =>  $parte[1],
                    "img" =>  $parte[1]
                );
                array_push($datos , $pos);
                $i++;
            }

            //$datos .= $linea;
        }
        fclose($file);
        //return json_encode($datos,JSON_UNESCAPED_UNICODE );
        return $datos;

        */
    }


    public function store(Request $r)
    {
        try{
            $m = new Unidadmedida;
            $m->medida = $r->input("nombre");

            $m->save();
            toastr()->success('Materia creada','Unidad de Medida');
            $e = "ok-create";
        }catch(Exception $e){
            $e = "error-create";
        }

        return $this->index($e);
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $r)
    {

    }


    public function destroy($id)
    {
        try{
            $cat = Unidadmedida::findOrFail($id);
            $cat->delete();
            toastr()->warning('Eliminado','Unidad de Medida');
            $e = "ok-delete";
        }catch(Exception $e){
            $cat = null;
            $e = "error-delete";
        }
        return $this->index($e);
    }

    public function updateOtro(Request $r)
    {
        try{
            $id = $r->input("idE");
            $cat = Unidadmedida::findOrFail($id);
            $cat->medida = $r->input("nombreE");
            $cat->save();
            toastr()->info('Actualizado','Unidad de Medida');
            $e = "ok-update";
        }catch(Exception $e){
            $cat = null;
            $e = "error-update";
        }
        return $this->index($e);
    }

    public function jsonPack(){

    }
}
