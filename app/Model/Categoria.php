<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $table = 'categoria';
    public $fillable = ['id','nombre_categoria'];
    public $timestamps = false;
}
