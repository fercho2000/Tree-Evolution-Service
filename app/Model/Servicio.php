<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table='servicio';
    public $fillable = ['nombreServicio','tipoServicio_idTipoServicio', 'estado'];
    public $timestamps = false;
}
