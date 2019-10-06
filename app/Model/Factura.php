<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "factura";
    protected $primaryKey = "folio";

    protected $fillable = [
        "venta",
    ];

    public function ventaF(){
        return $this -> belongsTo( Venta::class, "venta");
    }

}
