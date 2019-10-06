<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class PromocionProducto extends Model
{
    protected $table = "promocion_producto";
    public $timestamps = false;

    protected $fillable = [
        'promocion', 'producto', 'porcentaje',
    ];
}
