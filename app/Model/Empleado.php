<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public $table = 'empleado';
  
    protected $fillable = ['numero_idntificacion','nombre','apellido',
     'direccion','fotoPersonal',
     'numero_contacto', 'correo electronico',
      'social_security','cargo_id','estado','ciudad_id','genero_id'];
    public $timestamps = false;
}
