<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    protected $table = "dato";
    protected $primaryKey = "id";

    protected $fillable = [
        'domicilioparticular', 'sitioWeb',
    ];

    public function cliente(){
        return $this->belongsTo("oniyow\Model\Cliente","dato");
    }
    public function emails(){
        return $this->hasMany("oniyow\Model\Email","dato");
    }
    public function telefonos(){
        return $this->hasMany("oniyow\Model\Telefono","dato");
    }

}
