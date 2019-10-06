<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $table = "proveedor";
    protected $primaryKey = "id";

    public function datos(){
        return $this->belongsTo("oniyow\Model\Dato","dato");
    }

}
