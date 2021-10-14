<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KithasBitacora extends Model
{
    public $table = 'programacion_has_kit';
    protected $fillable = ['kit_id','bitacora_id'];
    public $timestamps = false;
}
