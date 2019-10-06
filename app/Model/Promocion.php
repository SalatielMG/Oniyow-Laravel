<?php

namespace oniyow\Model;

use oniyow\Model\Producto;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = "promocion";
    protected $primaryKey = "id";

    protected $fillable= [
        'fehcainicio', 'fechafinal', 'nombre',
    ];

    public function productos(){
        return $this->belongsToMany(Producto::class,"promocion_producto","promocion","producto")->withPivot("porcentaje");
    }
}
