<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $table = 'programacion';
    protected $fillable = ['ordenservicio_id', 'estado'];
    public $timestamps = false;
}
