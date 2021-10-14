<?php

namespace App\Http\Controllers;

use App\Model\OrdenServicio;
use App\Model\TipoServicio;
use App\Model\Cliente;
use App\Model\Servicio;
use App\Model\Abonos;
use App\Model\Estados;
use App\Model\Programacion;
use App\Model\Bitacora;
use App\Model\OrdenservicioDetalleServicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class OrdenServicioController extends Controller
{
    public function Ajaxconsultaservicios(Request $request)
    {
        $idTiposervicio = $request->idtiposervicio;
        $Servicios = Servicio::select('id', 'nombreServicio')
        ->where('estado', '=', 1)
        ->where('tipoServicio_idTipoServicio', '=', $idTiposervicio)->get();
        return response()->Json($Servicios);
    }

    public function crear()
    {
        $tipoServ = TipoServicio::all();
        $Clientes = Cliente::all();
        // $Servicios=Servicio::all();
        
        $UltimoRegistro = OrdenServicio::all()->last();
        


        return view('OrdenServicio.Ordenservicio', compact('tipoServ', 'Clientes', 'UltimoRegistro'));
    }

    public function index()
    {
        $tipoServ = TipoServicio::all();
        $Clientes = Cliente::all();

        $ConsultaOrdenServ = OrdenServicio::select(
            'ordenservicio.*',
            'cliente.nombre as Nombre_Cliente',
            'tiposervicio.nombreTipoServicio as Tipo_Servicio',
            'estados.nombreEstado as estadoactual',
            'estados.id as estadoid'
        )
      
        ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
        ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
        ->join('estados', 'ordenservicio.estados_idEstado', '=', 'estados.id')
        ->get();
        // dd($ConsultaOrdenServ);
        // $ConsultaUltimoRegistro[] ="";
        if ($ConsultaOrdenServ!=null) {
            foreach ($ConsultaOrdenServ as $key => $value) {
                $ConsultaUltimoRegistro[] =  Abonos::select('abonos.*')
                ->where('ordenServicio_idOrdenServicio', $value->id)->get()->last();

                if ($value->restante == 0 && $value->estadoid==1) {
                    $Cordenupdatestado = OrdenServicio::find($value->id);
                    $Cordenupdatestado->update([
                        'estados_idEstado'=>4,
                    ]);
                }
            }
        }
        


        //  dd($ConsultaUltimoRegistro);
        return view('OrdenServicio.ListarOrdenServicio', compact('ConsultaOrdenServ', 'ConsultaUltimoRegistro'));
    }

    public function index2()
    {
        return view('index2');
    }

    public function guardar(Request $request)
    {
        $datos = $request->all();
        $serv =$request->ServiciosOrden;
       
        $CantServicios= count($request->ServiciosOrden);

        // Estas Son Todas Las Variables Para Guardar En La Tabla Abonos
        $TAbono = $request->AbonoOrdenServicio;
        $FechaAbono= date('d/m/Y');
        $PrecioOrdenT= $request->Precio;
        $abonoRestante= ($PrecioOrdenT - $TAbono);
        $IdOrdenId=$datos['IdNuevaOrdenServ'];

        if ($request->hasFile('AdjuntarPermiso')==null && $request->hasFile('AdjuntarContrato') && $request->hasFile('AdjuntarCotizacion')) {

               // Preguntamos si viene archivo pdf de contrato
            $datos = $request->all();
            $file = $request->file('AdjuntarContrato');
            $NombreContrato = rand(0, 100).time().$file->getClientOriginalName();
            $destinationPath = public_path('/CarpetaPdfContrato');
            $file->move($destinationPath, $NombreContrato);
            

            // Preguntamos si viene archivo pdf de cotización
            
            $file = $request->file('AdjuntarCotizacion');
            $NombreCotiza = rand(0, 100).time().$file->getClientOriginalName();
            $destinationPath = public_path('/CarpetaPdfCotizaciòn');
            $file->move($destinationPath, $NombreCotiza);
            

            OrdenServicio::create([
                'descripcionServicio'=> $datos['descripcion'],
                'contratoAdjunto'=>$NombreContrato,
                'permisoCorteArbolAdjunto'=>'',
                'cotizacionAdjunta'=>$NombreCotiza,
                'fechaInicio'=> ($datos['FechaInicio']),
                'fechaFin'=>($datos['FechaFin']),
                'Precio'=>$datos['Precio'],
                'tipoServicio_idTipoServicio'=>$datos['nuevoTipoServicio'],
                'Cliente_idCliente'=>$datos['AgregarCliente'],
            ]);

            for ($i=0; $i < $CantServicios; $i++) {
          
                // Guardar los servicios en latabla detalle
                // La variable $i, corresponde a cada posición de array
                // La variable $serv, Corresponde al array que viene de los servicios
                OrdenservicioDetalleServicios::create([
                'ordenServicio_idOrdenServicio'=> $datos['IdNuevaOrdenServ'],
                'servicio_idServicio'=>$serv[$i]
             ]);
            }

            // Registramos la tabla abonos
            Abonos::create([
        'fechaAbono' => $FechaAbono,
        'totalAbonar'=>$TAbono,
        'abonoRestante'=>$abonoRestante,
        'ordenServicio_idOrdenServicio'=>$IdOrdenId
        ]);

            return redirect('/ordenservicio')->with('msg', 'Te has registrado correctamente');
        } else {
            // Preguntamos si viene archivo pdf de contrato
            if ($request->hasFile('AdjuntarContrato')) {
                $file = $request->file('AdjuntarContrato');
                $NombreContrato = rand(0, 100).time().$file->getClientOriginalName();
                $destinationPath = public_path('/CarpetaPdfContrato');
                $file->move($destinationPath, $NombreContrato);
            }

            // Preguntamos si viene archivo pdf de permiso
            if ($request->hasFile('AdjuntarPermiso')) {
                $file = $request->file('AdjuntarPermiso');
                $NombrePermisoA = rand(0, 100).time().$file->getClientOriginalName();
                $destinationPath = public_path('/CarpetaPdfPermisoArboles');
                $file->move($destinationPath, $NombrePermisoA);
            }

            // Preguntamos si viene archivo pdf de cotización
            if ($request->hasFile('AdjuntarCotizacion')) {
                $file = $request->file('AdjuntarCotizacion');
                $NombreCotiza = rand(0, 100).time().$file->getClientOriginalName();
                $destinationPath = public_path('/CarpetaPdfCotizaciòn');
                $file->move($destinationPath, $NombreCotiza);
            }
  
            OrdenServicio::create([
            'descripcionServicio'=> $datos['descripcion'],
            'contratoAdjunto'=>$NombreContrato,
            'permisoCorteArbolAdjunto'=>$NombrePermisoA,
            'cotizacionAdjunta'=>$NombreCotiza,
            'fechaInicio'=> ($datos['FechaInicio']),
            'fechaFin'=>($datos['FechaFin']),
            'Precio'=>$datos['Precio'],
            'tipoServicio_idTipoServicio'=>$datos['nuevoTipoServicio'],
            'Cliente_idCliente'=>$datos['AgregarCliente'],
        ]);


            for ($i=0; $i < $CantServicios; $i++) {
          
            // Guardar los servicios en latabla detalle
                // La variable $i, corresponde a cada posición de array
                // La variable $serv, Corresponde al array que viene de los servicios
                OrdenservicioDetalleServicios::create([
            'ordenServicio_idOrdenServicio'=> $datos['IdNuevaOrdenServ'],
            'servicio_idServicio'=>$serv[$i]
         ]);
            }

    
            // Registramos la tabla abonos
            Abonos::create([
            'fechaAbono' => $FechaAbono,
            'totalAbonar'=>$TAbono,
            'abonoRestante'=>$abonoRestante,
            'ordenServicio_idOrdenServicio'=>$IdOrdenId
            ]);
            return redirect('/ordenservicio')->with('msg', 'Te has registrado correctamente');
        }
    }

    public function editar($id)
    {

    // $consulta= OrdenServicio::find($id);
        $tipoServ = TipoServicio::all();
        $Clientes = Cliente::all();
        // Consulta de úlimo registro. abonos
        $ConsultaAbonos =  Abonos::select('abonoRestante', 'totalAbonar')
    ->where('ordenServicio_idOrdenServicio', $id)->get()->last();



        $ConsultaOrdenServ = OrdenServicio::select('ordenservicio.*', 'cliente.nombre as Nombre_Cliente', 'tiposervicio.nombreTipoServicio as Tipo_Servicio')
    ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
    ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
    ->where('ordenservicio.id', $id)
    ->first();

        $RegiroAllAbonos = Abonos::select('abonos.*')
    ->where('ordenServicio_idOrdenServicio', $id)->get();

        $SumaAb = 0;
        for ($i=0; $i <count($RegiroAllAbonos) ; $i++) {
            $SumaAb+=$RegiroAllAbonos[$i]->totalAbonar;
        }
    
        $PrecioOrden = $ConsultaOrdenServ->Precio;
        $PreccioRestanteA = $PrecioOrden -$SumaAb;

        // dd($ConsultaOrdenServ);
  
        $TblDtalleOrdenHasServicios = OrdenservicioDetalleServicios::select(
            'ordenservicio_has_servicio.*',
            'servicio.nombreServicio as Nombre_servicios'
        )
    ->join('servicio', 'ordenservicio_has_servicio.servicio_idServicio', '=', 'servicio.id')
    ->where('ordenservicio_has_servicio.ordenServicio_idOrdenServicio', $id)
    ->get();

        // Se crea esta variable con el fin de contar todos los servicios que tenga la orden
        // para en la vista saber que si solo existe uno, no deje eliminar este
        // ya que es obligatorio que la orden tenga almenos un servicio asociado
        $contarservicios= count($TblDtalleOrdenHasServicios);

//    Consulta para pasar solo los servicios no registrados a esta orden

        $NombreServiData[]='';
        if ($TblDtalleOrdenHasServicios!=null) {
            foreach ($TblDtalleOrdenHasServicios as $key => $value) {
                $NombreServiData[] = $value->Nombre_servicios;
            }
        }
        // Variable en la cual voy a coger el id del tipo de servicio para luego
        // buscar los servicios que tengan asociado este tipo
        $CogerTiposervicio = Servicio::select('tipoServicio_idTipoServicio')
->where('estado', 1)
->whereNotIn('nombreServicio', $NombreServiData)->first();

        if ($CogerTiposervicio!=null) {
            $Servicios = Servicio::select('servicio.*')
    ->where('estado', 1)
    ->where('tipoServicio_idTipoServicio', $CogerTiposervicio->tipoServicio_idTipoServicio)
    ->whereNotIn('nombreServicio', $NombreServiData)->get();
        } else {
            $Servicios ='';
        }



        return view('OrdenServicio.EditarOrden', compact('contarservicios', 'tipoServ', 'ConsultaOrdenServ', 'Clientes', 'Servicios', 'TblDtalleOrdenHasServicios', 'ConsultaAbonos', 'RegiroAllAbonos', 'PreccioRestanteA'));
    }
    

    public function update(Request $request)
    {
        // dd($request);

        $id = $request -> IdOrdServio;
        $masservicio= $request->AgregarMasServiciosOrden;
        if ($masservicio!=null) {
            for ($i=0; $i < count($masservicio) ; $i++) {
                OrdenservicioDetalleServicios::create([
                'ordenServicio_idOrdenServicio'=>$id,
                'servicio_idServicio'=>$masservicio[$i]
             ]);
            }
        }
       
        $data = OrdenServicio::find($id);
        $data -> descripcionServicio = $request -> Updatedescripcion;
        
        $ConsultaAbonos =  Abonos::select('abonoRestante')
        ->where('ordenServicio_idOrdenServicio', $id)->get()->last();


        // Actualizar Fichero Contrato
        if ($request->hasFile('UpdateContrato')=='') {
            $data -> contratoAdjunto = $request -> ContratoStorage;
        } else {

            //Buscamos y  Eliminamos fichero anterior y creamos el nuevo
            $NombreContratoBd = $request -> ContratoStorage;
            $rutaCompletaContrato =  public_path('CarpetaPdfContrato/'.$NombreContratoBd);
            unlink($rutaCompletaContrato);
            $file = $request->file('UpdateContrato');
            $NombreContratoUpdate = rand(0, 100).time().$file->getClientOriginalName();
            $destinationPath = public_path('/CarpetaPdfContrato');
            $file->move($destinationPath, $NombreContratoUpdate);
            $data -> contratoAdjunto = $NombreContratoUpdate ;
        }
        

      

        // Creaos las variables para preguntar la existencia de dicho archivos corte arboles en el fichero
        $NombrePermisoBd = $request -> PermisoStorage;
        $rutaCompletaPermiso =  public_path('CarpetaPdfPermisoArboles/'.$NombrePermisoBd);


        // Variable Para preguntar en un if tipo de servicio
        $CondicionRem= $request -> UpdateTipoServicio;

        if ($CondicionRem==2 && is_file($rutaCompletaPermiso)) {
            unlink($rutaCompletaPermiso);
      
            // $data -> permisoCorteArbolAdjunto ="" ;
        }
        // Actualizar Fichero Permiso
        if ($request->hasFile('UpdatePermiso')=='') {
            $data -> permisoCorteArbolAdjunto = $request -> PermisoStorage;
        } elseif (is_file($rutaCompletaPermiso)) {

       //Buscamos y  Eliminamos fichero anterior y luego se pasa a  crear uno nuevo
            unlink($rutaCompletaPermiso);

            $file = $request->file('UpdatePermiso');
            $NombrePermisoUpdate = rand(0, 100).time().$file->getClientOriginalName();
            $destinationPathArbol = public_path('/CarpetaPdfPermisoArboles');
            $file->move($destinationPathArbol, $NombrePermisoUpdate);
            $data -> permisoCorteArbolAdjunto = $NombrePermisoUpdate ;
        } else {

    // Si, el tipo de servicio es jardineria eliminaremos eliminamos el fichero ya que no hará parte  de la ORDSV

            // unlink($rutaCompletaPermiso);
            $file = $request->file('UpdatePermiso');
            $NombrePermisoUpdate = rand(0, 100).time().$file->getClientOriginalName();
            $destinationPathArbol = public_path('/CarpetaPdfPermisoArboles');
            $file->move($destinationPathArbol, $NombrePermisoUpdate);
            $data -> permisoCorteArbolAdjunto = $NombrePermisoUpdate ;
        }



        // Actualizar Fichero cotizacion Adjunta
        if ($request->hasFile('UpdateCotizacion')=='') {
            $data -> cotizacionAdjunta = $request -> CotizacionStorage;
        } else {

            //Buscamos y  Eliminamos fichero anterior y creamos el nuevo
            $NombreCotizacionBd = $request -> CotizacionStorage;
            $rutaCompletaCotizacion =  public_path('CarpetaPdfCotizaciòn/'.$NombreCotizacionBd);
            unlink($rutaCompletaCotizacion);
            $file = $request->file('UpdateCotizacion');
            $NombreCotizacionUpdate = rand(0, 100).time().$file->getClientOriginalName();
            $destinationPath = public_path('/CarpetaPdfCotizaciòn');
            $file->move($destinationPath, $NombreCotizacionUpdate);
            $data -> cotizacionAdjunta = $NombreCotizacionUpdate ;
        }

        $data -> fechaInicio = $request -> UpdateFechaInicio;
        $data -> fechaFin = $request -> UpdateFechaFin;
        $data -> Precio = $request -> UpdatePrecio;
        // dd($request -> UpdatePrecio);

        $data -> tipoServicio_idTipoServicio = $request -> UpdateTipoServicio;
        $data -> Cliente_idCliente = $request -> UpdateCliente;
        $data -> save();

        // Esta consulta la hago, co el objetivo de sumar todos los abonos registrados.
        // Para luego, al tener la suma total de esto ir teniedno control sobre lo faltante a pagar
        $ConsultaUpdate =  Abonos::select('abonos.*')
        ->where('ordenServicio_idOrdenServicio', $id)->get();

        $SumaAbonados = 0;
        for ($i=0; $i < count($ConsultaUpdate) ; $i++) {
            $SumaAbonados +=$ConsultaUpdate[$i]->totalAbonar;
        }

        
        
        //   Utilizare esta variable para traer todos los abonos ysumarlos,
        // luego para retar  y tener lo faltante de la orden por pagar
        //    $VarRegistroAbona = $ConsultaUpdate-> totalAbonar;

        $ConsultaUltimoRegistro =  Abonos::select('abonos.*')
        ->where('ordenServicio_idOrdenServicio', $id)->get()->last();
        $VarRegistroAbona = $ConsultaUltimoRegistro->totalAbonar;
        // dd($VarRegistroAbona);
        $VarPreio = $request -> UpdatePrecio;
        $VariFechaAbono = $ConsultaUltimoRegistro-> fechaAbono;
        $VarRestante= $ConsultaUltimoRegistro-> abonoRestante;
        $VarIdOrden = $ConsultaUltimoRegistro-> ordenServicio_idOrdenServicio;
        // $CalcuarUpdatResta es la variable que calcula segun el monto de la orden y los
        // Abonos registrados calculamos lo que falta  por pagar.
        $CalcuarUpdatResta = $VarPreio - $SumaAbonados;

        $ConsultaUltimoRegistro->update([
            'fechaAbono'=>$VariFechaAbono ,
            'totalAbonar'=>$VarRegistroAbona,
            'abonoRestante'=>$CalcuarUpdatResta,
            'ordenServicio_idOrdenServicio'=>$id
        ]);

        return redirect('/ordenservicio');
    }

        
    public function remover(Request $request)
    {
        $IdServicio = $request->id;
        $IdOrdnServicio = $request->idorden;

        // $data = DB::table('ordenservicio_has_servicio')->where([
        //     ['ordenServicio_idOrdenServicio', '=', $IdOrdnServicio],
        //     ['servicio_idServicio', '=', $IdServicio],
        // ])->first();
        // $data = DB::table('ordenservicio_has_servicio')->select('servicio_idServicio', 'ordenServicio_idOrdenServicio')
        // ->where('servicio_idServicio', $IdServicio)
        // ->first();
        // $data = OrdenservicioDetalleServicios::select("ordenservicio_has_servicio.")
        $query = DB::table('ordenservicio_has_servicio')
        ->where('ordenServicio_idOrdenServicio', '=', $IdOrdnServicio)
        ->where('servicio_idServicio', '=', $IdServicio)->delete();
      
        return response()->json([
            'mensaje' => 'The service was successfully removed',
        ]);
    }
    public function Abono(Request $request)
    {
        $FechaAbonar = date('d/m/Y');
        
        $IdOrdenIdenServ = $request->OrdenId;
        $TotalidaadOrden = $request->TotalPrecioOrden;
        $valorabonar = $request->ValorAbono;

        $ValorFalantePrecio = $request->FaltaPagarPrecio;
        $Operacion = $ValorFalantePrecio - $valorabonar;

        if ($ValorFalantePrecio==0) {
            return response()->json([
                'error' => 'The service order has already been paid in full',
                // "ValorOrden"=>$TotalidaadOrden,
                // "ValorestanteOrden"=> $abonoRestante
            ]);
        } elseif ($valorabonar > $ValorFalantePrecio) {
            return response()->json([
                'error' => 'The value you wish to pay exceeds the total price of the order',
                // "ValorOrden"=>$TotalidaadOrden,
                // "ValorestanteOrden"=> $abonoRestante
            ]);
        } else {
            $PrecioOrdenRestante = $request->ValorRestar;
            $abonoRestante = ($PrecioOrdenRestante - $valorabonar);
            
            // Registramos el abono
            Abonos::create([
                            'fechaAbono' => $FechaAbonar ,
                            'totalAbonar'=>$valorabonar,
                            'abonoRestante'=>$Operacion,
                            'ordenServicio_idOrdenServicio'=>$IdOrdenIdenServ
                            ]);
        
            return response()->json([
                    'mensaje' => 'The credit was registered',
                    'ValorOrden'=>$TotalidaadOrden,
                    'ValorestanteOrden'=> $Operacion
                ]);
        }
        
        return back();
    }

    // Metodo que sera ejecutado  para  consulta abono
    public function AbonoConsulta(Request $request)
    {
        $IdAbono = $request->id;
        $ConsultaA = Abonos::find($IdAbono);
        $PrecioConAbono = $ConsultaA->totalAbonar;

        return (response()->json($PrecioConAbono));
    }

    public function UpdateAbonoConsulta(Request $request)
    {
        $id = $request->idAbono;
        $CAbono = Abonos::find($id);
        $PrecioA = $request->EditPrecioAbonado;
        // Variables seran asignadas de la consulta
        $Fecha = $CAbono->fechaAbono;
        $RestaA = $CAbono->abonoRestante;
        $OrdenI = $CAbono->ordenServicio_idOrdenServicio;

        
        $CAbono->update([
            'fechaAbono'=>$Fecha,
            'totalAbonar'=>$PrecioA,
            'abonoRestante'=>$RestaA,
            'ordenServicio_idOrdenServicio'=>$OrdenI
        ]);

        return back();
    }

    public function show($id)
    {
        // $consulta= OrdenServicio::find($id);
        $tipoServ = TipoServicio::all();
        $Clientes = Cliente::all();
    
        $Servicios = Servicio::select('servicio.*')
    ->where('estado', '=', 1)->get();
        $ConsultaOrdenServ = OrdenServicio::select('ordenservicio.*', 'cliente.nombre as Nombre_Cliente', 'tiposervicio.nombreTipoServicio as Tipo_Servicio')
    ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
    ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
    ->where('ordenservicio.id', $id)
    ->first();
        // dd($ConsultaOrdenServ);
        $Servicios =Servicio::all();
        $TblDtalleOrdenHasServicios = OrdenservicioDetalleServicios::select(
            'ordenservicio_has_servicio.*',
            'servicio.nombreServicio as Nombre_servicios'
        )
    ->join('servicio', 'ordenservicio_has_servicio.servicio_idServicio', '=', 'servicio.id')
    ->where('ordenservicio_has_servicio.ordenServicio_idOrdenServicio', $id)
    ->get();
        $ConsultaOrdenServ = OrdenServicio::select('ordenservicio.*', 'cliente.nombre as Nombre_Cliente', 'tiposervicio.nombreTipoServicio as Tipo_Servicio')
    ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
    ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
    ->where('ordenservicio.id', $id)
    ->first();

        $RegiroAllAbonos = Abonos::select('abonos.*')
    ->where('ordenServicio_idOrdenServicio', $id)->get();

        $SumaAb = 0;
        for ($i=0; $i <count($RegiroAllAbonos) ; $i++) {
            $SumaAb+=$RegiroAllAbonos[$i]->totalAbonar;
        }
    
        $PrecioOrden = $ConsultaOrdenServ->Precio;
        $PreccioRestanteA = $PrecioOrden -$SumaAb;
        //   dd(($TblDtalleOrdenHasServicios));
        $ConsultaAbonos =  Abonos::select('abonoRestante', 'totalAbonar')
    ->where('ordenServicio_idOrdenServicio', $id)->get()->last();

        $RegiroAllAbonos = Abonos::select('abonos.*')
    ->where('ordenServicio_idOrdenServicio', $id)->get();
        return view('OrdenServicio.ShowOrdenServicio', compact('PreccioRestanteA', 'ConsultaAbonos', 'RegiroAllAbonos', 'tipoServ', 'ConsultaOrdenServ', 'Clientes', 'Servicios', 'TblDtalleOrdenHasServicios'));
    }

    public function Generar_PDF($id)
    {
        $OrdenServicio = OrdenServicio::select(
            'ordenservicio.*',
            'cliente.nombre',
            'cliente.apellidos',
            'tiposervicio.nombreTipoServicio as Tipo_Servicio',
            'cliente.NumeroDeContacto',
            'cliente.CorreoElectronico',
            DB::raw('CONCAT(ciudad.nombreCiudad,"-",cliente.direccion) as direccion'),
            'cliente.NumeroDeIdentificacion',
            'ordenservicio.Precio',
            'estados.nombreEstado'
        )
        ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
        ->join('ciudad', 'cliente.ciudad_idCiudad', '=', 'ciudad.id')
        ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
        ->join('estados', 'ordenservicio.estados_idEstado', '=', 'estados.id')
        ->where('ordenservicio.id', $id)
        ->get();

        $IdProgramacion = Programacion::select('Programacion.id')
        ->where('programacion.ordenservicio_id', '=', $id)
        ->first();

        $DiasBitacora = Bitacora::select('bitacora.*', 'empleado.nombre', 'empleado.apellido', 'estados.nombreEstado')
                ->where('bitacora.programacion_id', $IdProgramacion->id)
                ->join('empleado', 'bitacora.empleado_id', '=', 'empleado.id')
                ->join('estados', 'bitacora.estados_id', '=', 'estados.id')
                ->get();
        $date = date('Y-m-d');
        $view =  \View::make('OrdenServicio.OrdenservicioPdf', compact('OrdenServicio', 'DiasBitacora', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
}
