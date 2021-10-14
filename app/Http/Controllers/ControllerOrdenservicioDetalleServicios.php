<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\OrdenservicioDetalleServicios;

class ControllerOrdenservicioDetalleServicios extends Controller
{
    public function guardar(Request $request)
    {
        $datos = $request->all();
    
        OrdenservicioDetalleServicios::create([
            'ordenServicio_idOrdenServicio'=> $datos['IdOrdenServicio'],
            'servicio_idServicio'=>$datos[''],
        ]);

        return redirect('/ordenservicio');
    }
}
