<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "producto";
    protected $primaryKey = "id";

    protected $fillable = ['nombre', 'descripcion', 'stock', 'precio', 'imagen'];

    public function metodofabrica(){
        return $this->hasMany("oniyow\Model\MetodoFabrica","producto");
    }

    public function metodoraro(){ //Acceder a traves de un intermediario
        return $this->hasManyThrough('oniyow\Model\Produccion', 'oniyow\Model\MetodoFabrica', 'producto', 'metodo');
    }

    public function metodofabrica_produccion(){

        return $this->hasMany(MetodoFabrica::with("produccion"),"producto");
    }
}
