<?php

namespace App\Http\Controllers;

use App\Model\Estados;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function index()
    {
        $estado = Estados::all();
        return view('OrdenServicio.Estados', compact('estado'));
    }

    public function guardar(Request $request)
    {
        $datos = $request->all();
        Estados::create([
            'nombreEstado'=> $datos['nombreEstado']
        ]);
        return redirect('/estados');
    }

    public function editar(Request $request)
    {
        $id = $request->id;
        $consulta = Estados::find($id);
        return (response()->json($consulta));
    }

    public function update(Request $request)
    {
        $id = $request -> id;
        $data = Estados::find($id);
        $data -> nombreEstado = $request -> nombreEstado;
        $data -> save();
        return back();
    }

    public function delete(Request $request)
    {
        $id = $request -> id;
        $data = Estados::find($id);
        $response = $data -> delete();
    }
}
