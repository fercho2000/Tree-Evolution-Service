<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    protected $table = 'tiposervicio';
    

    protected $fillable = ['nombreTipoServicio','estado'];
    public $timestamps = false;
}
