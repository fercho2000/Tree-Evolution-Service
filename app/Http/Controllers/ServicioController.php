<?php

namespace App\Http\Controllers;

use App\Model\Servicio;
use App\Model\TipoServicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $tipoServ = TipoServicio::select('tiposervicio.*')
                    ->where('estado', '=', 1)->get();

        $ServicioConsulta = Servicio::select('servicio.*', 'tiposervicio.nombreTipoServicio as Tservicio')
        ->join('tiposervicio', 'servicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
        ->get();
        return view('OrdenServicio.Servicios', compact('ServicioConsulta', 'tipoServ'));
    }

    public function guardar(Request $request)
    {
        $datos = $request->all();
       
        Servicio::create([
            'nombreServicio'=> $datos['GuardarServicio'],
            'tipoServicio_idTipoServicio'=>$datos['nuevoTipoServicio'],
        ]);

        return redirect('/servicio');
    }

    public function editar(Request $request)
    {
        $id = $request->id;
        $consulta = Servicio::select('servicio.*', 'tiposervicio.nombreTipoServicio as nombre_servicio')
            ->join('tiposervicio', 'servicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
            ->where('servicio.id', $id)
            ->first();
        // $consulta = Servicio::find($id);

        return (response()->json($consulta));
    }

    public function update(Request $request)
    {
        // $datos = $request->all();
        //  var_dump($request -> id);
        // dd($request);
        $id = $request -> id;
        $data = Servicio::find($id);
        $data -> nombreServicio = $request -> EditNombreServicio;
        $data->tipoServicio_idTipoServicio= $request-> editarTipoServicio;
     
        $data -> save();
        return back();
    }

    public function CambioEstado(Request $request)
    {
        $id = $request -> id;
        $data = Servicio::find($id);
        $data->update([
            'estado' => $data->estado == 1 ? 0 : 1,
        ]);
        return response()->json([
            'mensaje' => 'Successful modification',
        ]);
    }
        
    public function delete(Request $request)
    {
        $id = $request -> id;
        $data = Servicio::find($id);
        $response = $data -> delete();
    }
}
