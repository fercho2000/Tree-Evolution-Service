<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $table = 'cargo';
    protected $fillable = ['nombre_cargo'];
    public $timestamps = false;
}
