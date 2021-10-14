<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    public $table = 'genero';
    protected $fillable=['NombreGenero'];
    public $timestamps = false;
}
