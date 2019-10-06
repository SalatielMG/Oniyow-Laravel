<?php

namespace oniyow\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //Talent-land
    public function calcularFecha($fechaNacimiento){
        //$hoy = getdate();
        $fechaActual = new DateTime();
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $diferencia = $fechaNacimiento -> diff($fechaActual);
        return "Años := " . $diferencia -> y;
    }
    public $Documento = [
        ["pageNumber" => 1, "startingChar" => 1, "endingChar" => 23],
        ["pageNumber" => 2, "startingChar" => 24, "endingChar" => 227],
        ["pageNumber" => 3, "startingChar" => 228, "endingChar" => 231]
    ];
    public function calcularPagina($indice){
        foreach ($this -> Documento as $doc)
            if($indice >= $doc["startingChar"] && $indice <= $doc["endingChar"])
                return "El indice del caracter buscado esta en la pagina: " . $doc["pageNumber"];
    }
}
