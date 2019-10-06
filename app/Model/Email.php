<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = "email";
    protected $primaryKey = "id";
    //
    protected $fillable = [
        'email', 'dato',
    ];
    public function dato(){
        return $this->belongsTo("oniyow\Model\Dato","id");
    }
}
