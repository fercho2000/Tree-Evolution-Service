<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpleadohasBitacora extends Model
{
    public $table = 'empleados_has_programacion';
    protected $fillable = ['empleado_id','bitacora_id'];
    public $timestamps = false;
}
