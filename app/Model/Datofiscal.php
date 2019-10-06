<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Datofiscal extends Model
{
    protected $table = "dato_fiscal";
    protected $primaryKey = "cliente";

    protected $fillable = [
        "cliente", "RFC", "calle", "numinterior", "numexterior", "colonia", "cp", "municipio", "estado",
    ];

    public function clienteC(){
        return $this -> belongsTo( Cliente::class, "cliente");
    }
}
