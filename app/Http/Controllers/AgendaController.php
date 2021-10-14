<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Model\Agenda;

class AgendaController extends Controller
{

    // Retorna la vista donde estan listas las agendas registradas
    public function Agendaindex()
    {
        $ConsultaAgenda = Agenda::all();

        return view('Agenda.Agenda', compact('ConsultaAgenda'));
    }

    public function Agendaguardar(Request $request)
    {
        $datos = $request->all();
       
        Agenda::create([
            'titulo'=> $datos['titulo'],
            'fecha_inicio'=>$datos['fecha_inicio'].' '.date('H:i:s', strtotime($request->hora_inicio)) ,
            'fecha_fin'=>$datos['fecha_inicio'].' '.date('H:i:s', strtotime($request->hora_final)) ,
        ]);

        return redirect('/index2');
        // return    dd($request);
    }

    // Controlador para pasar toda la información a las vistas del fullcalendar
    public function Agendafullcalendar()
    {
        $agenda = Agenda::select('id', 'titulo as title', 'fecha_inicio as start', 'fecha_fin as end', 'color')->get();
  
        return response()->Json($agenda);
    }

    public function AgendaEliminar(Request $request)
    {
        $IdEvento = $request->id;
        $query = DB::table('agenda')
        ->where('id', '=', $IdEvento)->delete();
      
        return response()->json([
            'mensaje' => 'The event was successfully eliminated',
        ]);
    }

    public function AgendaEditar(Request $request)
    {
        $id = $request->id;
        $query = DB::table('agenda')
        ->where('id', '=', $id)->first();

        return (response()->json($query));
    }

    public function AgendaUpdate(Request $request)
    {
    
        // Variable con la que buscaremos la agenda a editar
        $id = $request->id;
        // Las sguientes variables se crearan para luego concatenarlas con el fin de darle el forato de un datetime(año,mes,dia) ya que
        // llegan con un difrente por el request
        $año =substr($request->FechaAgenda, -4);
        $dia =substr($request->FechaAgenda, 0, 2);
        $mes = substr(substr($request->FechaAgenda, 3, 3), 0, 2);
        $fecha = $año.'-'.$mes.'-'.$dia;
        $AgendaUpdate = Agenda::find($id);
        $AgendaUpdate->titulo = $request->EditTitulo;
        $AgendaUpdate->fecha_inicio = $fecha.' '.date('H:i:s', strtotime($request->HoraInicioAgenda));
        $AgendaUpdate->fecha_fin    = $fecha.' '.date('H:i:s', strtotime($request->HoraFinAgenda));
        $AgendaUpdate->save();

        //  return  ( $fecha." ".date("H:i:s",strtotime($request->HoraFinAgenda)));
        return redirect('/index2');
    }
}
