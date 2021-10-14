<?php
namespace App\Http\Controllers;

use App\Model\Cliente;
use App\Model\Ciudad;
use App\Model\Genero;
use App\Model\OrdenServicio;
use Illuminate\Http\Request;
use Validator;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClietesExport;

class ClienteController extends Controller
{
    public function index()
    {
        $genero = Genero::all();
       
        $ciudad = Ciudad::all();
        $cliente = Cliente::select('cliente.*', 'ciudad.nombreCiudad as nombre_ciudad', 'genero.NombreGenero as nombre_genero')
        ->join('ciudad', 'cliente.ciudad_idCiudad', '=', 'ciudad.id')
        ->join('genero', 'cliente.Genero_idGenero', '=', 'genero.id')
        ->get();
        return view('OrdenServicio.Clientes', compact('cliente', 'genero', 'ciudad'));
    }


    
    public function Clientepdf($id)
    {
        $clientes = Cliente::select('cliente.*')
        ->where('cliente.id', $id)
        ->first();

        $cantidadOrdenes = OrdenServicio::select('ordenservicio.*')
        ->where('ordenservicio.Cliente_idCliente', $id)
        ->where('ordenservicio.estados_idEstado', 4)
        ->get();

        $ordenes = count($cantidadOrdenes);

        $date = date('Y-M-D');

        $fechaOrdenes = OrdenServicio::select('fechaInicio', 'fechaFin')
        ->where('ordenservicio.Cliente_idCliente', $id)
        ->first();
   

        $pdf = PDF::loadView('OrdenServicio.clientesPDF', compact('clientes', 'date', 'ordenes', 'fechaOrdenes'));
        return $pdf->stream('Reportes de los clientes');
    }


    public function guardar(Request $request)
    {
        $datos = $request->all();
        $request->validate([
            'NumeroDeIdentificacion' => 'bail|unique:cliente',
        ]);
        $validator = Validator::make($datos, [
            'NumeroDeIdentificacion' => 'required|unique:cliente',
        ]);
        // if($validator->fails()) {
          
        //     return response()->json([
        //         "error" =>"Imposible este cliente ya existe",
        //     ]);
        // }
        try {
            Cliente::create([
                    'NumeroDeIdentificacion'=> $datos['nuevoDocumentoId'],
                    'nombre'=>$datos['nuevoCliente'],
                    'apellidos'=>$datos['ApellidoCliente'],
                    'direccion'=>$datos['nuevaDireccion'],
                    'NumeroDeContacto'=>$datos['nuevoTelefono'],
                    'CorreoElectronico'=>$datos['nuevoEmail'],
                    'ciudad_idCiudad'=>$datos['SelectCiudad'],
                    'Genero_idGenero'=>$datos['SelectGenero']
                ]);
            return response()->json([
                    'mensaje' => 'It has been successfully registered',
                ]);
        } catch (\Exception $th) {
            return response()->json([
                   'error' =>'Impossible this client already exists',
                ]);
        }
        
           
        // return redirect("/clientes");
    }



    public function editar(Request $request)
    {
        $id = $request->id;
        $consulta = Cliente::select('cliente.*', 'ciudad.nombreCiudad as nombre_ciudad', 'genero.NombreGenero as nombre_genero')
        ->join('ciudad', 'cliente.ciudad_idCiudad', '=', 'ciudad.id')
        ->join('genero', 'cliente.Genero_idGenero', '=', 'genero.id')
        ->where('cliente.id', $id)
        ->first();
        // $consulta = Servicio::find($id);
        return (response()->json($consulta));
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NumeroDeIdentificacion' => 'required|unique:cliente',
        ]);
        if ($validator->fails()) {
            return redirect('/clientes')->withInput()->withErrors($validator);
        }
        try {
            $id = $request -> idCliente;
            $data = Cliente::find($id);
            $data -> NumeroDeIdentificacion = $request -> EditarDocumentoId;
            $data -> nombre = $request -> EditarCliente;
            $data -> apellidos = $request -> EditarApellidoCliente;
            $data -> direccion = $request -> EditarDireccion;
            $data -> NumeroDeContacto = $request -> EditarTelefono;
            $data -> CorreoElectronico = $request -> EditarEmail;
            $data -> ciudad_idCiudad = $request -> SelectEditarCiudad;
            $data -> Genero_idGenero = $request -> SelectEditarGenero;
            $data -> save();
            return back();
        } catch (\Exception $th) {
            return response()->json([
                'error' =>'Error updating',
            ]);
        }
    }
        
    public function delete(Request $request)
    {
        // $id = $request -> id;
        // $data = Cliente::find($id);
        // $response = $data -> delete();
    }

    public function ReporteExcecl()
    {
        return Excel::download(new ClietesExport, 'listaclientes.xlsx');
        Excel::loadView('folder.file', array('medicion' => $medicion))->export('xls');
    }
}
