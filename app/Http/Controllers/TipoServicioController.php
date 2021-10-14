<?php

namespace App\Http\Controllers;

use App\Model\TipoServicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    public function index()
    {
        // $tipoServ = TipoServicio::all();
  
        $tipoServ = TipoServicio::all();

        return view('OrdenServicio.tiposervicio', compact('tipoServ'));
    }


    public function guardar(Request $request)
    {
        $datos = $request->all();
        //    dd($datos);
        TipoServicio::create([
            'nombreTipoServicio'=> $datos['NuevoTipoServ']
        ]);

        return redirect('/tiposervicio');
    }

    public function editar(Request $request)
    {
        $id = $request->id;
        $consulta = TipoServicio::find($id);
        return (response()->json($consulta));
    }

    public function update(Request $request)
    {
        $id = $request -> id;
        $data = TipoServicio::find($id);
        $data -> nombreTipoServicio = $request -> nombreTipoServicio;
        $data -> save();
        return back();
    }

    public function CambioEstado(Request $request)
    {
        $id = $request -> id;
        $data = TipoServicio::find($id);
        $data->update([
            'estado' => $data->estado == 1 ? 0 : 1,
        ]);
        return response()->json([
            'mensaje' => 'Successful modification the status!',
        ]);
    }
}
