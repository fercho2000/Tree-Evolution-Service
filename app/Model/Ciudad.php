<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public $table = 'ciudad';
    protected $fillable=['id','nombreCiudad'];
    public $timestamps = false;
}
