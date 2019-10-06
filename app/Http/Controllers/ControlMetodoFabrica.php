<?php

namespace oniyow\Http\Controllers;

use oniyow\Model\MateriaPrima;
use oniyow\Model\MetodoFabrica;
use oniyow\Model\Produccion;
use oniyow\Model\Producto;
use Illuminate\Http\Request;
use DB;


class ControlMetodoFabrica extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view("metodofabrica.index",compact("productos"));


    }


    public function create()
    {

        if(!empty(session("materiasOcupa")))
            $materiasOcupa = session("materiasOcupa");


        $productos = Producto::all();
        $titulo = "Método de Fábrica";

        return view("metodofabrica.create",compact("productos","materiasOcupa","titulo"));
    }


    public function store(Request $r)
    {
        try{
            $materiasOcupa = session("materiasOcupa");
            $lista = [];
            foreach($materiasOcupa as $c){
                $lista[] = ["materiaprima"=>$c["id"],"cantidad"=>$c["cantidad"]];
            }

            $producto = $r->input("producto");
            $nombre = $r->input("nombre");
            $descripcion = $r->input("descripcion");

            $metodo =  new MetodoFabrica();
            $metodo -> producto = $producto;
            $metodo -> nombre = $nombre;
            $metodo -> descripcion = $descripcion;
            $metodo -> preciofabrica = 0;
            $metodo->save();


            $metodo->materias()->attach($lista);
            toastr()->success('Creado','Método de Fábrica');
            session( ["materiasOcupa"=>[] ] );
            return ["msj"=>true];
        }catch (Exception $e){
            return ["msj"=>$e];
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        try{
            $fabrica = MetodoFabrica::find($id);
            $fabrica->delete();
            $e = "ok-delete";
            toastr()->warning('Eliminado', 'Método de Fábrica');
        }catch(Exception $e){
            $fabrica = null;
            $e = "error-delete";
        }
        return $e;
    }




    public function materiaSearch(Request $r){

        $buscar = trim($r->input("buscar"));
        $sql = "SELECT m.*,u.medida FROM materiaprima as m,unidadmedida as u WHERE m.unidadmedida = u.id AND (nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%')";
        $materias = DB::select($sql);
        //dd($materias);
        return view("metodofabrica.materias",compact("materias"));
    }

    public function guardaMateria(Request $r){
        try{

            if(empty(session("materiasOcupa")))
                session( ["materiasOcupa"=>[] ] );

            $materiasOcupa = session("materiasOcupa");

            $cantidad = $r->input("cantidad");
            $id = $r->input("id");
            $m = MateriaPrima::find($id);

            //Obteniendo  precio de la materia en base a la ultima compra de esa materia
            $sql = "SELECT * FROM provisiona_materia AS pm,materiaprima AS m 
                    WHERE m.id = pm.materiaprima AND pm.provisiona = 
                    (SELECT MAX(soloX.provisiona) FROM 
                    (SELECT * FROM provisiona_materia WHERE materiaprima = $id) AS soloX)";
            $mat = DB::select($sql);
            if(empty($mat[0]))
                $precio = 0;
            else
                $precio = $mat[0]->precio;

            if(array_key_exists($m->id, $materiasOcupa)){
                $materiasOcupa[$m->id]["cantidad"] +=  $cantidad;
            }else
                $materiasOcupa[$m->id] = ["id"=>$m->id,"cantidad"=>$cantidad,"nombre"=>$m->nombre,"precio"=>$precio];

            session(["materiasOcupa"=>$materiasOcupa]);


            return view("metodofabrica.materiasEnOcupa",compact("materiasOcupa"));

        }catch(Exception $e){
            return null;
        }
    }

    public function eliminarMateria($id){
        $carrito = session("materiasOcupa");
        unset($carrito[$id]); //Para destruir elementos enn PHP
        session(["materiasOcupa"=>$carrito]);
    }

    public function cancelarMetodoFabrica(){
        session(["materiasOcupa"=>[]]);
        if( count(session("materiasOcupa")) == 0)
            return ["r"=>true];
        return ["r"=>false];
    }


    public function recargaSelecMetodo(Request $r){
        $id = $r ->input("id");
        $metodos = MetodoFabrica::with("materias")->where("producto","=","$id")->get();

        $options = "";
        $vistaMaterias = "";
        $id1 = 0;
        $total = 1;
        if(empty(count($metodos))){
            $options .= "<option value='0'> No existen métodos de fábrica</option>";
            $total = 0;
        }else{
            $id1 = $metodos[0]->id;
            foreach ($metodos as $m){
                $options .= "<option value=' $m->id '> $m->nombre </option>";
            }

            //Para regcargar las materias del primer metodo

        }




        $json["total"] = $total;
        $json["html"] = $options;
        $json["id"] = $id1;

        return $json;
    }

    public function vistaM($id1){
        $materiasOcupa = MetodoFabrica::with("materias")->where("id","=","$id1")->get();
        return view("metodofabrica.VerMateriasOcupa", compact("materiasOcupa"));
    }

    public function materiasOcupa(Request $r){
        $id = $r ->input("id");
        $materiasOcupa = MetodoFabrica::with("materias")->where("id","=","$id")->get();
        //$materiasOcupa = $materiasOcupa[0]->materias;
        $metId = $materiasOcupa[0]->id;
        $totalProducciones = Produccion::with("metodofabrica")->where("metodo","=","$metId")->count();
        return view("metodofabrica.VerMateriasOcupa", compact("materiasOcupa","totalProducciones"));
    }


}



