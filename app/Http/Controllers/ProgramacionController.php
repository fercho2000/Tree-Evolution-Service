<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\OrdenServicio;
use App\Model\TipoServicio;
use App\Model\Cliente;
use App\Model\Empleado;
use App\Model\Cargo;
use App\Model\Kit;
use App\Model\KithasImplemento;
use App\Model\NovedadImplemento;
use App\Model\Implemento;
use App\Model\OrdenservicioDetalleServicios;
use App\Model\Programacion;
use App\Model\Bitacora;
use App\Model\EmpleadohasBitacora;
use App\Model\KithasBitacora;
use App\Model\Estados;
use App\Model\NovedadOrden;
use Illuminate\Support\Facades\DB;

class ProgramacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IdOrdenesYaProgramadas = Programacion::select('programacion.ordenservicio_id')
        ->join('ordenservicio', 'programacion.ordenservicio_id', '=', 'ordenservicio.id')
        ->get();

        $OrdenServicio = OrdenServicio::select('ordenservicio.fechaInicio', 'ordenservicio.fechaFin', 'cliente.nombre', 'cliente.apellidos', 'tiposervicio.nombreTipoServicio as Tipo_Servicio', 'ordenservicio.id')
            ->where('ordenservicio.estados_idEstado', '=', 3)
            ->whereNotIn('ordenservicio.id', $IdOrdenesYaProgramadas)
            ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
            ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
            ->get();

        $Programacion = Programacion::select(
            'programacion.*',
            'ordenservicio.fechaInicio as fechai',
            'ordenservicio.fechaFin as fechaf',
            'cliente.nombre as nombreCliente',
            'cliente.apellidos as apellidoCliente',
            'estados.nombreEstado',
            'ordenservicio.estados_idEstado',
            'ordenservicio.id as idOrden'
        )
            ->join('ordenservicio', 'programacion.ordenservicio_id', '=', 'ordenservicio.id')
            ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
            ->join('estados', 'ordenservicio.estados_idEstado', '=', 'estados.id')
            ->get();


        return view('OrdenServicio.programacion', compact('Programacion', 'OrdenServicio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $idEmpleado = $request->idEmpleado;

        $OrdenServicio = Programacion::select(
            'programacion.ordenservicio_id',
            'ordenservicio.*',
            'cliente.nombre',
            'cliente.apellidos',
            'tiposervicio.nombreTipoServicio as Tipo_Servicio',
            'ordenservicio.estados_idEstado'
        )
            ->join('ordenservicio', 'programacion.ordenservicio_id', '=', 'ordenservicio.id')
            ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
            ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
            ->where('programacion.id', '=', $id)
            ->first();

        $IdOrdenServicio = Programacion::select('ordenservicio_id')
            ->where('programacion.id', '=', $id)
            ->first();

        $TblDtalleOrdenHasServicios = OrdenservicioDetalleServicios::select(
            'ordenservicio_has_servicio.*',
            'servicio.nombreServicio as Nombre_servicios'
        )
            ->join('servicio', 'ordenservicio_has_servicio.servicio_idServicio', '=', 'servicio.id')
            ->where('ordenservicio_has_servicio.ordenServicio_idOrdenServicio', $IdOrdenServicio->ordenservicio_id)
            ->get();

        $EmpleadoDisponibles = Empleado::select('empleado.*', 'cargo.nombre_cargo')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->where('empleado.estado', '=', 1)
            ->get();

        $IdImplementosNoDisponibles = KithasImplemento::select('implementostrabajo_has_kit.kit_id')
        ->join('implemento', 'implementostrabajo_has_kit.implemento_id', 'implemento.id')
        ->where('implemento.estado', 1)
        ->distinct()
        ->get();

        $KitsDisponibles = Kit::select('kit.*', 'servicio.nombreServicio')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->where('kit.estado', '=', 0)
            ->whereNotIn('kit.id', $IdImplementosNoDisponibles)
            ->get();

        $ShowKit = Kit::select('kit.*', 'servicio.nombreServicio')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->where('kit.id', $id)
            ->first();

        $BitacoraInfo = Bitacora::select('bitacora.*', 'empleado.nombre as Nombre_Empleado', 'empleado.apellido as Apellido_Empleado', 'estados.nombreEstado')
            ->join('empleado', 'bitacora.empleado_id', '=', 'empleado.id')
            ->join('estados', 'bitacora.estados_id', '=', 'estados.id')
            ->where('bitacora.programacion_id', '=', $id)
            ->get();

        $idBitacoras = Bitacora::select('bitacora.id')
            ->where('bitacora.programacion_id', '=', $id)
            ->get();

        $Empleados = EmpleadohasBitacora::select('empleados_has_programacion.bitacora_id', 'empleado.*', 'cargo.nombre_cargo')
            ->whereIn('bitacora_id', $idBitacoras)
            ->join('empleado', 'empleados_has_programacion.empleado_id', 'empleado.id')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->get();

        $Kits = KithasBitacora::select('programacion_has_kit.bitacora_id', 'kit.*', 'servicio.nombreServicio')
            ->whereIn('bitacora_id', $idBitacoras)
            ->join('kit', 'programacion_has_kit.kit_id', 'kit.id')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->get();

        $EstadosProgramacion = Estados::select('estados.*')
            ->get();

        $EstadoActual = Bitacora::select('bitacora.estados_id', 'estados.nombreEstado')
            ->join('estados', 'bitacora.estados_id', '=', 'estados.id')
            ->get();

        $UltimaBitacora =  Bitacora::all()->last();

        return view('OrdenServicio.CreateProgramacion', compact('OrdenServicio', 'BitacoraInfo', 'Kits', 'EstadosProgramacion', 'EstadoActual', 'Empleados', 'TblDtalleOrdenHasServicios', 'EmpleadoDisponibles', 'KitsDisponibles', 'id', 'UltimaBitacora'));
    }

    public function VerOrdenes(Request $request)
    {
        // Registar en la tabla de programacion
        $id = $request->id;

        Programacion::create([
            'ordenservicio_id' => $id
        ]);

        $Orden = OrdenServicio::select('ordenservicio.*', 'cliente.nombre', 'cliente.apellidos', 'tiposervicio.nombreTipoServicio as Tipo_Servicio')
            ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
            ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
            ->where('ordenservicio.id', $id)
            ->first();

        $TblDtalleOrdenHasServicios = OrdenservicioDetalleServicios::select(
            'ordenservicio_has_servicio.*',
            'servicio.nombreServicio as Nombre_servicios'
        )
            ->join('servicio', 'ordenservicio_has_servicio.servicio_idServicio', '=', 'servicio.id')
            ->where('ordenservicio_has_servicio.ordenServicio_idOrdenServicio', $id)
            ->get();

        return (response()->json(array('var1' => $Orden, 'var2' => $TblDtalleOrdenHasServicios, 'mensaje' => 'Registro éxitoso')));
    }

    public function VerDiasBitacora(Request $request)
    {
        $idProgramacion = $request->id;

        $DiasBitacora = Bitacora::select('bitacora.*', 'empleado.nombre as Nombre_Empleado', 'empleado.apellido as Apellido_Empleado', 'estados.nombreEstado')
            ->join('empleado', 'bitacora.empleado_id', '=', 'empleado.id')
            ->join('estados', 'bitacora.estados_id', '=', 'estados.id')
            ->where('bitacora.programacion_id', '=', $idProgramacion)
            ->get();

        return (response()->json(array('BitacoraInfo' => $DiasBitacora)));
    }

    // PENDIENTE


    public function verEmpleadoKits(Request $request)
    {
        $id = $request->idprogramacion;
        $Fecha = $request->fecha;
        $HoraInicio = $request->horainicio;
        $HoraFin = $request->horafin;

        $IdEmpleadosNoDisponibles = EmpleadohasBitacora::select('empleados_has_programacion.empleado_id')
            ->leftJoin('bitacora', 'empleados_has_programacion.bitacora_id', '=', 'bitacora.id')
            ->where('bitacora.programacion_id', '=', $id)
            ->where('bitacora.fecha', '=', $Fecha)
            ->where('bitacora.horaInicio', '>', $HoraInicio)
            ->where('bitacora.horaFin', '<', $HoraFin)
            ->get();

        $EmpleadoDisponibles = Empleado::select('empleado.*', 'cargo.nombre_cargo')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->whereNotIn('empleado.id', $IdEmpleadosNoDisponibles)
            ->get();

        $IdKitsNoDisponibles = KithasBitacora::select('programacion_has_kit.kit_id')
            ->leftJoin('bitacora', 'programacion_has_kit.bitacora_id', '=', 'bitacora.id')
            ->where('bitacora.programacion_id', '=', $id)
            ->where('bitacora.fecha', '=', $Fecha)
            ->where('bitacora.horaInicio', '>', $HoraInicio)
            ->where('bitacora.horaFin', '<', $HoraFin)
            ->get();

        $KitsDisponibles = Kit::select('kit.*', 'servicio.nombreServicio')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->whereNotIn('kit.id', $IdKitsNoDisponibles)
            ->where('kit.estado', '=', 0)
            ->get();

        return (response()->json([
            'Kits' => $KitsDisponibles,
            'Empleados' => $EmpleadoDisponibles
        ]));
    }


    public function verEmpleado(Request $request)
    {
        $id = $request->idEmpleado;

        $ShowEmpleado = Empleado::select('empleado.*', 'cargo.nombre_cargo')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->where('empleado.id', $id)
            ->first();

        return (response()->json($ShowEmpleado));
    }

    public function verKit(Request $request)
    {
        $id = $request->id;
        $ShowKit = Kit::select('kit.*', 'servicio.nombreServicio')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->where('kit.id', $id)
            ->first();

        $KitImpleme = KithasImplemento::select('implemento_id')
        ->where('kit_id', '=', $id)
        ->get();

        if (count($KitImpleme)==0) {
            $Mensaje = 'Information: This kit does not have assigned implements';
             
            return (response()->json(array('Kit' => $ShowKit, 'Mensaje' => $Mensaje)));
        } else {
            return (response()->json($ShowKit));
        }
    }

    public function Nuevosimplementosalkit(Request $request)
    {
        $id = $request->idKit;
        $parametro = $request->Parametro;

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
            ->where('implemento.nombre_implemento', 'LIKE', "%$parametro%")
            ->where('implemento.Estado', '0')
            ->get();

        return (response()->json($ListarImple));
    }

    public function ActualizarKit(Request $request)
    {
        $Implementos = $request->all();
        $Implements = $request->idimplementos;

        for ($i = 0; $i < count($Implements); $i++) {
            KithasImplemento::create([
                'kit_id' => $Implementos['kit_id'],
                'implemento_id' => $Implements[$i]
            ]);
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Bitacora = $request->all();
        $Bitacora = new Bitacora();
        $Bitacora->descripcion = $request->DescripcionProgramacion;
        $Bitacora->fecha = $request->Fecha_Programacion;
        $Bitacora->horaInicio = $request->Hora_Inicio;
        $Bitacora->horaFin = $request->Hora_Fin;
        $Bitacora->programacion_id = $request->idprogramacion;
        $Bitacora->empleado_id = $request->Responsable;
        $Bitacora->save();

        //Registrar en la de detalle empleados has kit
        $Empleados = count($request->empleados);
        $Empleadosid = $request->empleados;
        for ($i = 0; $i < $Empleados; $i++) {
            EmpleadohasBitacora::create([
                'bitacora_id' => $request->UltimaBitacora,
                'empleado_id' => $Empleadosid[$i]
            ]);
        }

        $Kits = count($request->kits);
        $Kitsid = $request->kits;
        for ($i = 0; $i < $Kits; $i++) {
            KithasBitacora::create([
                'bitacora_id' => $request->UltimaBitacora,
                'kit_id' => $Kitsid[$i]
            ]);
        }

        return redirect()->back();
    }


    public function RegistrarNovedad(Request $request)
    {
        $IdOrdenServicio = $request->IdOrden;
        $FechaNovedad = $request->FechaNovedad;
        $Descripcion = $request->Descripcion;

        $RegistrarNovedad = new NovedadOrden();
        $RegistrarNovedad->descripcion = $Descripcion;
        $RegistrarNovedad->fechaNovedad = $FechaNovedad;
        $RegistrarNovedad->ordenServicio_idOrdenServicio = $IdOrdenServicio;
        $RegistrarNovedad->save();

        return (response()->json($RegistrarNovedad));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function VerEmpleadosBitacora(Request $request)
    {
        $id = $request->id;

        $VerEmpleadoBitacora = EmpleadohasBitacora::select('empleados_has_programacion.empleado_id', 'empleado.*', 'cargo.nombre_cargo')
            ->join('empleado', 'empleados_has_programacion.empleado_id', '=', 'empleado.id')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->where('empleados_has_programacion.bitacora_id', '=', $id)
            ->get();

        return (Response()->json($VerEmpleadoBitacora));
    }

    public function VerKitsBitacora(Request $request)
    {
        $id = $request->id;

        $VerKitsBitacora = KithasBitacora::select('programacion_has_kit.kit_id', 'kit.*', 'servicio.nombreServicio')
            ->join('kit', 'programacion_has_kit.kit_id', '=', 'kit.id')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->where('programacion_has_kit.bitacora_id', '=', $id)
            ->get();

        return (Response()->json($VerKitsBitacora));
    }

    public function showBitacora(Request $request)
    {
        $id = $request->id;

        $OrdenServicio = Programacion::select(
            'programacion.ordenservicio_id',
            'ordenservicio.*',
            'cliente.nombre',
            'cliente.apellidos',
            'tiposervicio.nombreTipoServicio as Tipo_Servicio',
            'ordenservicio.estados_idEstado'
        )
            ->join('ordenservicio', 'programacion.ordenservicio_id', '=', 'ordenservicio.id')
            ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
            ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
            ->where('programacion.id', '=', $id)
            ->first();

        $IdOrdenServicio = Programacion::select('programacion.ordenservicio_id')
            ->where('programacion.id', '=', $id)
            ->first();

        $TblDtalleOrdenHasServicios = OrdenservicioDetalleServicios::select(
            'ordenservicio_has_servicio.*',
            'servicio.nombreServicio as Nombre_servicios'
        )
            ->join('servicio', 'ordenservicio_has_servicio.servicio_idServicio', '=', 'servicio.id')
            ->where('ordenservicio_has_servicio.ordenServicio_idOrdenServicio', $IdOrdenServicio->ordenservicio_id)
            ->get();

        $BitacoraInfo = Bitacora::select('bitacora.*', 'empleado.nombre as Nombre_Empleado', 'empleado.apellido as Apellido_Empleado', 'estados.nombreEstado')
            ->join('empleado', 'bitacora.empleado_id', '=', 'empleado.id')
            ->join('estados', 'bitacora.estados_id', '=', 'estados.id')
            ->where('bitacora.programacion_id', '=', $id)
            ->get();

        $VerKitsBitacora = KithasBitacora::select('programacion_has_kit.kit_id', 'kit.*', 'servicio.nombreServicio')
            ->join('kit', 'programacion_has_kit.kit_id', '=', 'kit.id')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->where('programacion_has_kit.bitacora_id', '=', $id)
            ->get();

        $VerEmpleadoBitacora = EmpleadohasBitacora::select('empleados_has_programacion.empleado_id', 'empleado.*', 'cargo.nombre_cargo')
            ->join('empleado', 'empleados_has_programacion.empleado_id', '=', 'empleado.id')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->where('empleados_has_programacion.bitacora_id', '=', $id)
            ->get();

        return view('OrdenServicio.showProgramacion', compact('BitacoraInfo', 'OrdenServicio', 'IdOrdenServicio', 'TblDtalleOrdenHasServicios', 'VerKitsBitacora', 'VerEmpleadoBitacora'));
    }

    public function show(Request $request)
    {
        $id = $request->id;

        $ConsultaBitacora = Bitacora::select('bitacora.*', 'empleado.nombre as Nombre_Empleado', 'empleado.apellido as Apellido_Empleado', 'estados.nombreEstado')
            ->join('empleado', 'bitacora.empleado_id', '=', 'empleado.id')
            ->join('estados', 'bitacora.estados_id', '=', 'estados.id')
            ->where('bitacora.id', '=', $id)
            ->first();

        $VerKitsBitacora = KithasBitacora::select('programacion_has_kit.kit_id', 'kit.*', 'servicio.nombreServicio')
            ->join('kit', 'programacion_has_kit.kit_id', '=', 'kit.id')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->where('programacion_has_kit.bitacora_id', '=', $id)
            ->get();

        $VerEmpleadoBitacora = EmpleadohasBitacora::select('empleados_has_programacion.empleado_id', 'empleado.*', 'cargo.nombre_cargo')
            ->join('empleado', 'empleados_has_programacion.empleado_id', '=', 'empleado.id')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->where('empleados_has_programacion.bitacora_id', '=', $id)
            ->get();

        return (response()->json(array('Bitacora' => $ConsultaBitacora, 'Kits' => $VerKitsBitacora, 'Empleados' => $VerEmpleadoBitacora)));
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

        $ConsultaBitacoraEdit = Bitacora::select('bitacora.*', 'empleado.nombre as Nombre_Empleado', 'empleado.apellido as Apellido_Empleado', 'estados.nombreEstado')
            ->join('empleado', 'bitacora.empleado_id', '=', 'empleado.id')
            ->join('estados', 'bitacora.estados_id', '=', 'estados.id')
            ->where('bitacora.id', '=', $id)
            ->first();

        $VerKitsBitacoraEdit = KithasBitacora::select('programacion_has_kit.kit_id', 'kit.*', 'servicio.nombreServicio')
            ->join('kit', 'programacion_has_kit.kit_id', '=', 'kit.id')
            ->join('servicio', 'kit.servicio_id', '=', 'servicio.id')
            ->where('programacion_has_kit.bitacora_id', '=', $id)
            ->get();
        

        $VerEmpleadoBitacoraEdit = EmpleadohasBitacora::select('empleados_has_programacion.empleado_id', 'empleado.*', 'cargo.nombre_cargo')
            ->join('empleado', 'empleados_has_programacion.empleado_id', '=', 'empleado.id')
            ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
            ->where('empleados_has_programacion.bitacora_id', '=', $id)
            ->get();

        $CountEmpleados = count($VerEmpleadoBitacoraEdit);

        return (response()->json(array('BitacoraEdit' => $ConsultaBitacoraEdit, 'KitsEdit' => $VerKitsBitacoraEdit, 'EmpleadosEdit' => $VerEmpleadoBitacoraEdit , 'ValidarEmpl' => $CountEmpleados)));
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
        $idBitacora = $request->IdBitacoraModificar;
        $Bitacora = Bitacora::find($idBitacora);
        $Bitacora->fecha = $request->Fecha_Programacion;
        $Bitacora->horaInicio = $request->Hora_Inicio;
        $Bitacora->horaFin = $request->Hora_Fin;
        $Bitacora->descripcion = $request->DescripcionProgramacion;
        $Bitacora->empleado_id = $request->select_responsable;
        $Bitacora->save();

        if ($request->empleados != null) {
            $Empleados = count($request->empleados);
            $Empleadosid = $request->empleados;
            for ($i = 0; $i < $Empleados; $i++) {
                EmpleadohasBitacora::create([
                    'bitacora_id' => $idBitacora,
                    'empleado_id' => $Empleadosid[$i]
                ]);
            }
            return redirect()->back();
        }
        if ($request->kits != null) {
            $Kits = count($request->kits);
            $Kitsid = $request->kits;
            for ($i = 0; $i < $Kits; $i++) {
                KithasBitacora::create([
                    'bitacora_id' => $idBitacora,
                    'kit_id' => $Kitsid[$i]
                ]);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyEmpleadosBitacora(Request $request)
    {
        $idBitacora = $request->idBitacora;
        $idEmpleado = $request->idEmpleado;

        $DeleteEmpleado = DB::table('empleados_has_programacion')->where('empleados_has_programacion.bitacora_id', '=', $idBitacora)
            ->where('empleados_has_programacion.empleado_id', '=', $idEmpleado)->delete();

        return (response()->json([
            'Confirm' => 'The Employee has been eliminated successfully'
        ]));
    }

    public function destroyKitsBitacora(Request $request)
    {
        $idBitacora = $request->idBitacora;
        $idKit = $request->idKit;

        $DeleteKit = DB::table('programacion_has_kit')->where('programacion_has_kit.bitacora_id', '=', $idBitacora)
            ->where('programacion_has_kit.kit_id', '=', $idKit)->delete();

        return (response()->json([
            'Confirm' => 'The Kit has been eliminated successfully'
        ]));
    }

    public function destroyOrdenServicio(Request $request)
    {
        $idOrdenservicio = $request->id;
        try {
            $OrdenServicio =  OrdenServicio::find($idOrdenservicio);

            if ($OrdenServicio == false) {
                return response()->json([
                    'errors' => 'No se encontro este identificador'
                ]);
            }

            if ($OrdenServicio->estados_idEstado == 2) {
                $OrdenServicio->update([
                    'estados_idEstado' => $OrdenServicio->estados_idEstado = 1
                ]);
                return (response()->json([
                    'Confirmar' => 'The service order has been successfully completed'
                ]));
            }
            if ($OrdenServicio->estados_idEstado == 3) {
                $OrdenServicio->update([
                    'estados_idEstado' => $OrdenServicio->estados_idEstado = 2
                ]);
                return (response()->json([
                    'Confirmacionestado' => 'The Service Order happened to be in process'
                ]));
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        try {
            $Bitacora =  Bitacora::find($id);

            if ($Bitacora == false) {
                return response()->json([
                    'errors' => 'No se encontro este identificador'
                ]);
            }

            if ($Bitacora->estados_id == 3) {
                $Bitacora->update([
                    'estados_id' => $Bitacora->estados_id = 2
                ]);
                return (response()->json($Bitacora));
            } elseif ($Bitacora->estados_id == 2) {
                $Bitacora->update([
                    'estados_id' => $Bitacora->estados_id = 1
                ]);
                return (response()->json($Bitacora));
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage()
            ]);
        }
    }

    public function Bitacora()
    {
        $Bitacora = Bitacora::select(
            DB::raw('CONCAT(fecha," ",horaInicio) as start'),
            DB::raw('CONCAT("Cliente: ",cliente.nombre," ","Tipo de servicio: ",tiposervicio.nombreTipoServicio) as title'),
            DB::raw('CONCAT(fecha," ",horaFin) as end'),
            'color',
            'bitacora.id'
        )
            ->join('programacion', 'bitacora.programacion_id', '=', 'programacion.id')
            ->join('ordenservicio', 'programacion.ordenservicio_id', '=', 'ordenservicio.id')
            ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
            ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
            ->get();

        return (response()->json($Bitacora));
    }
}
