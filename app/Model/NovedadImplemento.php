<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NovedadImplemento extends Model
{
    public $table = 'novedadimplemento';
    protected $fillable = ['descripcion','fecha_novedad','implemento_id','empleado_id','estado'];
    public $timestamps = false;
}
