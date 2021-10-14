<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests;
use Illuminate\Support\Facades\Input;
use App\Model\Kit;
use App\Model\KithasImplemento;
use App\Model\NovedadImplemento;
use App\Model\Implemento;
use App\Model\Servicio;
use App\Model\Categoria;
use Illuminate\Support\Str;
use Validator;
use Response;
use View;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Kit = Kit::select('kit.*', 'servicio.nombreServicio')
        ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
        ->get();
       

        return view('Kits.kit', compact('Kit'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function TraerImplementos(Request $request)
    {
        $id = $request->id;
        $Implemento = Implemento::find($id);

        return (response()->json($Implemento));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Kit = Kit::select('kit.*', 'servicio.*')
        ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
        ->get();

        $IdNovedadImplementos = NovedadImplemento::select('novedadimplemento.implemento_id')
        ->where('novedadimplemento.estado', 1)
        ->get();

        $Implementos = Implemento::select('implemento.*', 'categoria.nombre_categoria')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->whereNotIn('implemento.id', $IdNovedadImplementos)
        ->where('implemento.estado', '=', 0)
        ->get();

        $Servicio = Servicio::all();

        $UltimoRegistro = Kit::all()->last();

        return view('Kits.create', compact('Kit', 'Implementos', 'UltimoRegistro', 'Servicio'));
    }

    public function MostrarImplemento(Request $request)
    {
        $id = $request->id;
      
        $Implementos = Implemento::select('implemento.*', 'categoria.nombre_categoria')
      ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
      ->where('implemento.id', $id)
      ->first();

        return (response()->json($Implementos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kit = $request->all();
        $kit = new kit();
        $kit->nombre_kit = $request->nombre_kit;
        $kit->servicio_id = $request->servicio_id;
        $kit->save();

        if ($request->idimplementos != null) {
            $Implementos = $request->all();
            $ValidarArray = count($request->idimplementos);
            $implementosKit = $request->idimplementos;
            for ($i=0; $i < count($implementosKit) ; $i++) {
                KithasImplemento::create([
                        'kit_id' => $Implementos['id'],
                        'implemento_id' => $implementosKit[$i]
                    ]);
            }
            return redirect()->route('kit');
        } else {
            return redirect()->route('kit');
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
        $KitInfo = Kit::select('kit.*', 'servicio.nombreServicio')
        ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
        ->where('kit.id', $id)
        ->get();
        $KitImple = KithasImplemento::select(
            'implementostrabajo_has_kit.*',
            'implemento.codigo_implemento',
            'implemento.nombre_implemento',
            'implemento.imagen',
            'implemento.estado'
        )
        ->join('implemento', 'implementostrabajo_has_kit.implemento_id', '=', 'implemento.id')
        ->where('implementostrabajo_has_kit.kit_id', $id)
        ->get();
        
        return view('Kits.show')->with('KitInfo', $KitInfo)
                                ->with('KitImple', $KitImple);
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
        $KitInfo = Kit::select('kit.*', 'servicio.nombreServicio')
        ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
        ->where('kit.id', $id)
        ->get();
        
        $KitImple = KithasImplemento::select(
            'implementostrabajo_has_kit.*',
            'implemento.codigo_implemento',
            'implemento.nombre_implemento',
            'implemento.imagen'
        )
        ->join('implemento', 'implementostrabajo_has_kit.implemento_id', '=', 'implemento.id')
        ->where('implementostrabajo_has_kit.kit_id', $id)
        ->get();

        $IdImplesKit = KithasImplemento::select('implementostrabajo_has_kit.implemento_id')
        ->where('implementostrabajo_has_kit.kit_id', '=', $id)
        ->get();

        $IdNovedadImples = NovedadImplemento::select('novedadimplemento.implemento_id')
        ->where('novedadimplemento.estado', 1)
        ->get();

        $ListarImple = Implemento::select('implemento.*', 'categoria.nombre_categoria')
       ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
       ->whereNotIn('implemento.id', $IdImplesKit)
       ->whereNotIn('implemento.id', $IdNovedadImples)
       ->where('implemento.estado', '=', 0)
       ->get();

        $Servicio = Servicio::all();

        return view('Kits.edit')->with('KitInfo', $KitInfo)
                                ->with('ListarImple', $ListarImple)
                                ->with('KitImple', $KitImple)
                                ->with('Servicio', $Servicio);
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
        $idKit = $request->id;
        $KitInfo = Kit::find($idKit);
        $KitInfo->nombre_kit = $request->nombre_del_kit;
        $KitInfo->servicio_id = $request->servicio_id;
        $KitInfo->save();
    }

    public function updateImplementos(Request $request)
    {
        $Implementos = $request->all();
        $implementosKit = $request->idimplementos;
        
        if ($request->idimplementos != null) {
            for ($i=0; $i < count($implementosKit) ; $i++) {
                KithasImplemento::create([
                    'kit_id' => $Implementos['kit_id'],
                    'implemento_id' => $implementosKit[$i]
                ]);
            }
            return redirect()->route('kit');
        } else {
            return redirect()->route('kit');
        }
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
            $kit =  Kit::find($id);
         
            if ($kit == false) {
                return response()->json([
                 'errors' => 'No se encontro este identificador'
             ]);
            }
            $kit->update([
                'estado' => $kit->estado==1?0:1
            ]);
         
            return (response()->json($kit));
        } catch (\Exception $error) {
            return response()->json([
                 'error' =>$error->getMessage()
             ]);
        }
    }
    public function Generar_PDF(Request $request)
    {
        $id = $request->id;
        $Kit = Kit::select('kit.nombre_kit', 'servicio.nombreServicio')
        ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
        ->where('kit.id', $id)
        ->get();
        $KitImple = KithasImplemento::select(
            'implementostrabajo_has_kit.*',
            'implemento.codigo_implemento',
            'implemento.nombre_implemento',
            'implemento.imagen',
            'categoria.nombre_categoria'
        )
        ->join('implemento', 'implementostrabajo_has_kit.implemento_id', '=', 'implemento.id')
        ->join('categoria', 'implemento.categoria_id', '=', 'categoria.id')
        ->where('implementostrabajo_has_kit.kit_id', $id)
        ->get();
        $date = date('Y-m-d');
        $view =  \View::make('Kits.KitReport', compact('Kit', 'KitImple', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }

    public function Generar_PDF_General(Request $request)
    {
        $Kit = Kit::select('kit.*', 'servicio.nombreServicio')
        ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
        ->get();

        $date = date('Y-m-d');
        $view =  \View::make('Kits.KitReportGeneral', compact('Kit', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
}
