<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Provisiona extends Model
{
    protected $table = "provisiona";
    protected $primaryKey = "id";

    public function materias(){
        return $this->belongsToMany(MateriaPrima::class,"provisiona_materia","provisiona","materiaprima")->withPivot("precio","cantidad");
    }

    public function proveedor(){
        return $this->belongsTo("oniyow\Model\Proveedor","proveedor");
    }


}
