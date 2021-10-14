<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NovedadOrden extends Model
{
    public $table = 'novedadesordenesservicio';
    protected $fillable = ['descripcion','fechaNovedad','ordenServicio_idOrdenServicio'];
    public $timestamps = false;
}
