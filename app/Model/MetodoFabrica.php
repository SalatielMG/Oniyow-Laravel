<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class MetodoFabrica extends Model
{
    protected $table = "metodofabrica";
    protected $primaryKey = "id";
    public $timestamps = false;

    //Todas funcionan
    public function materias(){
        return $this->belongsToMany(MateriaPrima::class,"ocupa","metodofabrica","materiaprima")->withPivot("cantidad");
    }

    public function productos(){
        return $this->belongsTo("oniyow\Model\Producto","producto");
    }

    public function produccion(){
        return $this->hasMany("oniyow\Model\Produccion","metodo")->orderByDesc("created_at");
    }
}
