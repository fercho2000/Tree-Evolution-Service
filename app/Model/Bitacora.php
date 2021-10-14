<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
    protected $fillable = ['fecha', 'horaInicio','horaFin','descripcion','programacion_id','estados_id','Empleados_idEmpleado_Responsable'];
    public $timestamps = false;
}
