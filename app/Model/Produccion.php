<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = "produccion";
    protected $primaryKey = "id";


    public function metodofabrica(){
        return $this->belongsTo("oniyow\Model\MetodoFabrica","metodo");
    }




}
