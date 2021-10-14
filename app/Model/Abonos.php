<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Abonos extends Model
{
    public $table = 'abonos';
    protected $fillable = ['fechaAbono','totalAbonar','abonoRestante','ordenServicio_idOrdenServicio'];
    public $timestamps = false;
}
