<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    public $table = 'ordenservicio';


    protected $fillable = ['descripcionServicio','contratoAdjunto','permisoCorteArbolAdjunto',
    'cotizacionAdjunta','fechaInicio','fechaFin','Precio','tipoServicio_idTipoServicio',
    'estados_idEstado','Cliente_idCliente'];
    // public $timestamps = false;
}
