<?php

namespace oniyow\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $table = "cliente";
    protected $primaryKey = "dato";
    use Notifiable;

    protected $fillable = [
        'dato', 'nombre', 'apellido', 'tipo', 'usuario', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function datoC(){
        return $this->belongsTo(Dato::class,"dato");
    }

    public function compras(){
        return $this -> hasMany(Venta::class, "cliente");
    }

    public function datoFiscal(){
        return $this -> belongsTo(Datofiscal::class, "dato");
    }

}
