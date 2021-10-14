<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    public $table = 'visita';
    public $fillable = ['fecha_visita', 'hora_inicio', 'hora_fin','descripcion','cliente_id','estado'];
    public $timestamps = false;
}
