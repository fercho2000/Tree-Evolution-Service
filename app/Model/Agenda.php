<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
    public $table = 'agenda';
    protected $fillable = ['titulo','fecha_inicio','fecha_fin','color'];
    public $timestamps = false;
}
