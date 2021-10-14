<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    public $table = 'kit';
    protected $fillable = ['nombre_kit','servicio_id','estado'];
    public $timestamps = false;
}
