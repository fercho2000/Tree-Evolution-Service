<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use App\Model\Visita;
use App\Model\Cliente;
use Validator;
use Response;
use View;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visita = Visita::select(
            'visita.*',
            'cliente.NumeroDeIdentificacion',
            'cliente.nombre',
            'cliente.apellidos',
            'cliente.direccion',
            'cliente.NumeroDeContacto',
            'cliente.CorreoElectronico'
        )
        ->join('cliente', 'visita.cliente_id', '=', 'cliente.id')
        ->get();

        $Cliente = Cliente::all();

        return view('Visitas.visitas', compact('visita', 'Cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Visit = new Visita();
        $Visit->descripcion = $request->descripcion;
        $Visit->fecha_visita = $request->fecha_vist.' '.date('H:m:s', strtotime($request->horaini));
        $Visit->hora_inicio = $request->horaini;
        $Visit->hora_fin = $request->fecha_vist.' '.date('H:m:s', strtotime($request->horafin)) ;
        $Visit->cliente_id = $request->get_value_cliente;
        $Visit->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $visita = Visita::select('visita.*', 'cliente.*')
        ->join('cliente', 'visita.cliente_id', '=', 'cliente.id')
        ->where('visita.id', $id)
        ->first();

        return (response()->json($visita));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $IdVisita = $request->id;
        $ConsultaVisita = Visita::select('visita.*', 'cliente.nombre', 'cliente.apellidos')
        ->join('cliente', 'visita.cliente_id', '=', 'cliente.id')
        ->where('visita.id', '=', $IdVisita)
        ->first();

        return (response()->json($ConsultaVisita));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->idVisit;
        $VisitUp = Visita::find($id);
        $VisitUp->descripcion = $request->edit_descript;
        $VisitUp->fecha_visita = $request->edit_fecha_vist.' '.date('H:m:s', strtotime($request->edit_horaini));
        $VisitUp->hora_inicio = $request->edit_horaini;
        $VisitUp->hora_fin = $request->edit_fecha_vist.' '.date('H:m:s', strtotime($request->edit_horafin));
        $VisitUp->cliente_id = $request->idclient;
        $VisitUp->save();
        return redirect() -> back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        try {
            $visita =  Visita::find($id);
         
            if ($visita == false) {
                return response()->json([
                 'errors' => 'No se encontro este identificador'
             ]);
            }
            $visita->update([
                'estado'=>$visita->estado==0?1:0,
                'estado'=>$visita->estado==1?2:1
            ]);
         
            return (response()->json($visita));
        } catch (\Exception $error) {
            return response()->json([
                 'error' =>$error->getMessage()
             ]);
        }
    }

    public function consultafullcalendar()
    {
        $consultavi = Visita::select('id', 'descripcion as title', 'fecha_visita as start', 'color')->get();

        return response()->Json($consultavi);
    }

    public function Generar_PDF()
    {
        $visitasPendientes = Visita::select(
            'visita.*',
            'cliente.NumeroDeIdentificacion',
            'cliente.nombre',
            'cliente.apellidos',
            'cliente.direccion',
            'cliente.NumeroDeContacto',
            'cliente.CorreoElectronico'
        )
        ->join('cliente', 'visita.cliente_id', '=', 'cliente.id')
        ->where('visita.estado', '=', 0)
        ->get();

        $visitasEnProceso = Visita::select(
            'visita.*',
            'cliente.NumeroDeIdentificacion',
            'cliente.nombre',
            'cliente.apellidos',
            'cliente.direccion',
            'cliente.NumeroDeContacto',
            'cliente.CorreoElectronico'
        )
        ->join('cliente', 'visita.cliente_id', '=', 'cliente.id')
        ->where('visita.estado', '=', 1)
        ->get();

        $visitasCompletadas = Visita::select(
            'visita.*',
            'cliente.NumeroDeIdentificacion',
            'cliente.nombre',
            'cliente.apellidos',
            'cliente.direccion',
            'cliente.NumeroDeContacto',
            'cliente.CorreoElectronico'
        )
        ->join('cliente', 'visita.cliente_id', '=', 'cliente.id')
        ->where('visita.estado', '=', 2)
        ->get();

        $date = date('Y-m-d');
        $view =  \View::make('Visitas.VisitReport', compact('visitasPendientes', 'visitasEnProceso', 'visitasCompletadas', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
}
