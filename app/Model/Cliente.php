<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $table = 'cliente';
    protected $fillable = ['NumeroDeIdentificacion','nombre','apellidos','direccion',
                          'NumeroDeContacto','CorreoElectronico','ciudad_idCiudad','Genero_idGenero'];
    public $timestamps = false;
}
