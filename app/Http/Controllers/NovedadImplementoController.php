<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use App\Model\NovedadImplemento;
use App\Model\Implemento;
use App\Model\Empleado;
use Validator;
use View;
use Alert;

class NovedadImplementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showNovedad = NovedadImplemento::select('novedadimplemento.*', 'implemento.imagen', 'implemento.codigo_implemento', 'implemento.nombre_implemento')
        ->join('implemento', 'novedadimplemento.implemento_id', '=', 'implemento.id')
        ->get();

        $Empleado = Empleado::all();
        $Implemento = Implemento::all();

        return view('Novedades.novedad', compact('showNovedad', 'Empleado', 'Implemento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $implemento = $request->implemento_id;

        $rules = array(
            'fecha_novedad' => 'required',
            'implemento_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray()
            ));
        }
         
        // $UltimaNovedad =  NovedadImplemento::all()->last();  validando novedad
        $ValidarNovedad = NovedadImplemento::where([
            ['novedadimplemento.implemento_id', '=', $implemento],
            ['novedadimplemento.estado','=',1]
            ])
            ->get();

        if (count($ValidarNovedad)>0) {
            return response()->json([
                 'error' => 'The implement is already with an active novelty'
             ]);
        } else {
            $idImple = $request->implemento_id;
            $Implemento = Implemento::find($idImple);
            $Implemento->update([
                'estado' => $Implemento->estado==0?1:1
            ]);
            $Novedad = new NovedadImplemento();
            $Novedad->descripcion = $request->descripcion;
            $Novedad->fecha_novedad = $request->fecha_novedad;
            $Novedad->implemento_id = $request->implemento_id;
            $Novedad->empleado_id = $request->empleado_id;
            $Implemento->estado== 0 ? 1 : 1;
            $Novedad->save();
            return response()->json($Novedad);
        }
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
        
        $ValidarEmpleado = NovedadImplemento::select('novedadimplemento.*')->where(
            'novedadimplemento.id',
            '=',
            $id
        )->whereNull('novedadimplemento.empleado_id')
            ->get();
        
        if (count($ValidarEmpleado)==1) {
            $NovedadVer = NovedadImplemento::select('novedadimplemento.*', 'implemento.imagen', 'implemento.codigo_implemento', 'implemento.nombre_implemento', 'categoria.nombre_categoria')
        ->join('implemento', 'novedadimplemento.implemento_id', '=', 'implemento.id')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->where('novedadimplemento.id', $id)
        ->get();
        }
        if (count($ValidarEmpleado)==0) {
            $NovedadVer = NovedadImplemento::select(
                'novedadimplemento.*',
                'implemento.imagen',
                'implemento.codigo_implemento',
                'empleado.nombre',
                'empleado.apellido',
                'empleado.correo_electronico',
                'empleado.numero_identificacion',
                'empleado.numero_contacto',
                'implemento.nombre_implemento',
                'categoria.nombre_categoria'
            )
            ->join('implemento', 'novedadimplemento.implemento_id', '=', 'implemento.id')
            ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
            ->join('empleado', 'novedadimplemento.empleado_id', '=', 'empleado.id')
            ->where('novedadimplemento.id', $id)
            ->get();
        }
        
        return view('Novedades.shownovedad', compact('NovedadVer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $novedad = NovedadImplemento::select(
            'novedadimplemento.*',
            'implemento.nombre_implemento',
            'empleado.nombre',
            'empleado.apellido'
        )
        ->join('implemento', 'novedadimplemento.implemento_id', '=', 'implemento.id')
        ->join('empleado', 'novedadimplemento.empleado_id', '=', 'empleado.id')
        ->where('novedadimplemento.id', $id)
        ->first();

        return (response()->json($novedad));
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
        $id = $request->idNovedad;
        $Novedad = NovedadImplemento::find($id);
        $Novedad->descripcion = $request->edit_descripcion;
        $Novedad->fecha_novedad = $request->edit_fecha;
        $Novedad->implemento_id = $request->get_value_imp;
        $Novedad->empleado_id = $request->get_value_emp;
        $Novedad->save();
        return redirect() -> back() -> with('success', 'Ha Sido Actualizo');
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
            $novedad =  NovedadImplemento::find($id);

            $IdImple = NovedadImplemento::select('novedadimplemento.implemento_id')
            ->where('novedadimplemento.id', '=', $id)
            ->first();

            $Implemento = Implemento::find($IdImple);
         
            if ($novedad == false) {
                return response()->json([
                 'errors' => 'No se encontro este identificador'
             ]);
            }
            $novedad->update([
                'estado' => $novedad->estado==1?0:0
            ]);
            return (response()->json($novedad));

            $Implemento->update([
                'estado' => $Implemento->estado==1?0:0
            ]);
        } catch (\Exception $error) {
            return response()->json([
                 'error' =>$error->getMessage()
             ]);
        }
    }

    public function Generar_PDF()
    {
        $ImpleDispo = Implemento::select('implemento.*', 'categoria.nombre_categoria')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->get();
        $ImpleNovedad = NovedadImplemento::select('novedadimplemento.*', 'implemento.codigo_implemento', 'implemento.nombre_implemento', 'empleado.nombre', 'empleado.apellido')
        ->join('implemento', 'novedadimplemento.implemento_id', '=', 'implemento.id')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->join('empleado', 'novedadimplemento.empleado_id', '=', 'empleado.id')
        ->where('novedadimplemento.estado', 1)
        ->get();

        $ImpleNovedadRepa = NovedadImplemento::select('novedadimplemento.*', 'implemento.codigo_implemento', 'implemento.nombre_implemento', 'empleado.nombre', 'empleado.apellido')
        ->join('implemento', 'novedadimplemento.implemento_id', '=', 'implemento.id')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->join('empleado', 'novedadimplemento.empleado_id', '=', 'empleado.id')
        ->where('novedadimplemento.estado', 0)
        ->get();

        $date = date('Y-m-d');
        $view =  \View::make('Novedades.NovedadReport', compact('ImpleNovedad', 'ImpleNovedadRepa', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
}
