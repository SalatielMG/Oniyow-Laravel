<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    protected $table = "materiaprima";
    protected $primaryKey = "id";

    public $timestamps = false;

    public function unidad(){
        return $this->belongsTo("oniyow\Model\Unidadmedida","unidadmedida");
    }
}
