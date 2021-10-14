<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Implemento extends Model
{
    public $table = 'implemento';
    protected $fillable = ['imagen','codigo_implemento','nombre_implemento','categoria_id','estado'];
    public $timestamps = false;
}
