<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "venta";
    protected $primaryKey = "id";

    public function productos(){
        return $this -> belongsToMany(Producto::class,"producto_venta","venta","producto") -> withPivot("precio", "cantidad", "porcentaje");
    }

    public function clienteC(){
        return $this -> belongsTo(Cliente::class, "cliente");
    }

}
