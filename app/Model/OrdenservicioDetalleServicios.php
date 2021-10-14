<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrdenservicioDetalleServicios extends Model
{
    public $table = 'ordenservicio_has_servicio';
    protected $fillable=['ordenServicio_idOrdenServicio','servicio_idServicio'];
    public $timestamps = false;
}
