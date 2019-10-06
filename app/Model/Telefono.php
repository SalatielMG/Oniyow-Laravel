<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = "telefono";
    protected $primaryKey = "id";
    //
    protected $fillable = [
        'numero', 'dato',
    ];
    public function dato(){
        return $this->belongsTo("oniyow\Model\Dato","id");
    }
}
