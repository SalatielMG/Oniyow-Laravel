<?php

namespace oniyow\Http\Controllers;

use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use oniyow\Model\Promocion;
use oniyow\Model\Producto;
use oniyow\Model\PromocionProducto;

class ControlPromocion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promociones = Promocion::all();
        return view("promociones.index", compact("promociones"));
    }
    public function productosAjax()
    {
        $productos = Producto::all();
        return compact("productos");
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
    public function store(Request $request)
    {
        //dd($request -> all());
        $lista = [];
        $Arreglo = json_decode($request -> input("productos"));

        //dd($Arreglo);
        foreach ($Arreglo as $arr){
            //dd($arr -> producto);
            $lista[] = ["producto" => $arr -> producto, "porcentaje" => $arr -> porcentaje];
        }
        //dd($lista);
        $promocion = Promocion::create([
            "fehcainicio" => $request -> input("datepicker"),
            "fechafinal" => $request -> input("datepicker2"),
            "nombre" => $request -> input("nombre"),
        ]);
        $promocion -> productos() -> attach($lista);
        return redirect(route("promocion.index"));
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
