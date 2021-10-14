<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use App\Model\Implemento;
use App\Model\Categoria;
use App\Model\NovedadImplemento;
use App\Model\Empleado;
use Validator;
use Response;
use View;
use Alert;

class ImplementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Imple = Implemento::select('implemento.*', 'categoria.nombre_categoria')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->get();
        
        $Categoria = Categoria::all();

        return view('implemento.implemento', compact('Imple', 'Categoria'));
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
        $Implemento = new Implemento();
        
        $request->validate([
            'codigo_implemento' => 'bail|unique:implemento',
            'imagen'=> 'mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->hasFile('input-21')==null) {
            $Implemento->codigo_implemento = $request->codigo_implemento;
            $Implemento->nombre_implemento = $request->nombre_implemento;
            $Implemento->categoria_id = $request->get_value_cate;
            $Implemento->save();

            return redirect()->back();
        } elseif ($request->hasFile('input-21')) {
            $file = $request->file('input-21');
            $name = time().$file->getClientOriginalName();
            $destinationPath = public_path('/images');
            $file->move($destinationPath, $name);
            $Implemento->imagen = $name;
            $Implemento->codigo_implemento = $request->codigo_implemento;
            $Implemento->nombre_implemento = $request->nombre_implemento;
            $Implemento->categoria_id = $request->get_value_cate;
            $Implemento->save();

            return redirect()->back();
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
        
        
        $Implemento = Implemento::select('implemento.*', 'categoria.nombre_categoria')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->where('implemento.id', $id)
        ->first();

        return (response()->json($Implemento));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $idImplemento = $request->id;
        $Imple = Implemento::select('implemento.*', 'categoria.nombre_categoria')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->where('implemento.id', $idImplemento)
        ->first();

        return (response()->json($Imple));
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
        if ($request->hasFile('imganePhoto')==null) {
            $id = $request->id;
            $ImplementoUpd = Implemento::find($id);
            $ImplementoUpd->codigo_implemento = $request->edit_codigo_implemento;
            $ImplementoUpd->nombre_implemento = $request->edit_nombre_implemento;
            $ImplementoUpd->categoria_id = $request->get_value_impl;
            $ImplementoUpd->save();
            return redirect() -> back();
        } elseif ($request->hasFile('imganePhoto')) {
            $id = $request->id;
            $ImplementoUpd = Implemento::find($id);
            $file = $request->file('imganePhoto');
            $name = time().$file->getClientOriginalName();
            $destinationPath = public_path('/images');
            $file->move($destinationPath, $name);
            $ImplementoUpd->imagen =  $name;
            $ImplementoUpd->codigo_implemento = $request->edit_codigo_implemento;
            $ImplementoUpd->nombre_implemento = $request->edit_nombre_implemento;
            $ImplementoUpd->categoria_id = $request->get_value_impl;
            $ImplementoUpd->save();
            return redirect() -> back();
        }
    }

    /**
     * Remove te specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        
        try {
            $Imple =  Implemento::find($id);
            $ValidarNovedadExiste = NovedadImplemento::select('novedadimplemento.id')
            ->where('novedadimplemento.implemento_id', '=', $id)
            ->where('novedadimplemento.estado', '=', 1)
            ->first();
         
            if ($Imple == false) {
                return response()->json([
                 'errors' => 'No se encontro este identificador'
             ]);
            }
            if ($ValidarNovedadExiste!=null) {
                return response()->json([
                    'Reparacion' => 'This implement is in maintenance'
                ]);
            } else {
                $Imple->update([
                'estado' => $Imple->estado==0?1:0,
            ]);
                return (response()->json($Imple));
            }
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
        $ImpleNovedad = NovedadImplemento::select('novedadimplemento.*', 'implemento.*', 'empleado.*')
        ->join('implemento', 'novedadimplemento.implemento_id', '=', 'implemento.id')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->join('empleado', 'novedadimplemento.empleado_id', '=', 'empleado.id')
        ->get();
        $date = date('Y-m-d');
        $view =  \View::make('implemento.ToolReport', compact('ImpleDispo', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
}
