<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Empleado;
use App\Model\Genero;
use App\Model\Ciudad;
use App\Model\Cargo;
use Illuminate\Support\Facades\Storage;
use Caffeinated\Shinobi\Models\Role;
use App\Model\User;
use PDF;

class empleadoController extends Controller
{
    public function index()
    {
        $empleado = Empleado::select(
            'empleado.*',
            'cargo.nombre_cargo as nombreCargo',
            'genero.NombreGenero as nombreGenero',
            'ciudad.nombreCiudad as nombreCiudad'
        )
       ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
       ->join('genero', 'empleado.genero_id', '=', 'genero.id')
       ->join('ciudad', 'empleado.ciudad_id', '=', 'ciudad.id')
       ->get();

        $genero = Genero::all();
        $ciudad = Ciudad::all();
        $cargo = Cargo::all();

        return view('empleado.listar', compact('empleado', 'genero', 'ciudad', 'cargo'));
    }


    public function pdf($id)
    {
        $empleado = Empleado::select(
            'empleado.*',
            'cargo.nombre_cargo as nombreCargo',
            'genero.NombreGenero as nombreGenero',
            'ciudad.nombreCiudad as nombreCiudad'
        )
      ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
      ->join('genero', 'empleado.genero_id', '=', 'genero.id')
      ->join('ciudad', 'empleado.ciudad_id', '=', 'ciudad.id')
      ->where('empleado.id', $id)
      ->first();
        $date = date('Y-m-d');

        $genero = Genero::all();
        $ciudad = Ciudad::all();
        $cargo = Cargo::all();

        $pdf = PDF::loadView('empleado.pdf', compact('empleado', 'genero', 'ciudad', 'cargo', 'date'));
        return $pdf->stream('Datos del empleado');
    }


    public function CrearUser($id)
    {
        $empleado = Empleado::select('empleado.id', 'empleado.nombre', 'empleado.apellido', 'empleado.correo_electronico', 'empleado.estado', 'numero_identificacion')
       ->where('empleado.id', $id)
       ->first();
        $roles = Role::get();
        if ($empleado->estado==0) {
            return Redirect("empleado/$id/mostrar");
        }
        
        return view('empleado.CrearUser', compact('empleado', 'roles'));
    }
    
    public function CrearUserr(Request $request)
    {
        $validator = [
            'name' => 'required|max:45',
            'email' => 'required|max:60|unique:users,email',
            'password' => 'required|max:225',
            'roles' => 'required'
        ];
        $mensaje = [
            'required' => 'The field :attribute is required',
            'mimes'    => 'Enter another format for the :attribute',
            'max'      => 'Enter a shorter value for :attribute',
            'unique'    => 'The :attribute already exist, enter a different one.'
        ];
        $this->validate($request, $validator, $mensaje);
        
        $input = $request->all();
        
        
        $users = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'empleado_id' => $input['empleado_id'],
        ]);
        $users->roles()->sync($request->get('roles'));
        
        return redirect('empleado');
    }
   
    public function create()
    {
        $empleado = Empleado::all();
        $genero = Genero::all();
        $ciudad = Ciudad::all();
        $cargo = Cargo::all();
        return view('empleado.registrar', compact('empleado', 'genero', 'ciudad', 'cargo'));
    }

  
    public function store(Request $request)
    {
        $id = $request->id;

        $campos = [
            'numero_identificacion' => 'required|max:11|unique:empleado,numero_identificacion,' . $id,
            'nombre'                => 'required|string|max:45',
            'apellido'              => 'required|string|max:45',
            'direccion'             => 'required|string|max:45',
            'numero_contacto'       => 'required|max:11',
            'correo_electronico'    => 'required|email|max:45',
            'social_security'       => 'required|max:11|unique:empleado,social_security,' . $id,
            'cargo_id'              => 'required|max:11',
            'ciudad_id'             => 'required|max:11',
            'genero_id'             => 'required|max:11',
            'fotoPersonal'          => 'mimes:jpeg,png,jpg,gif',
        ];

        $mensaje = [
            'required' => 'The field :attribute is required',
            'mimes'    => 'Enter another format for the personal photo',
            'max'      => 'Enter a shorter value for :attribute',
            'unique'    => 'The :attribute already exist, enter a different one.',
            'email'    => 'Enter a valid email.'
        ];

        $this->validate($request, $campos, $mensaje);

        
        $input=request()->except('_token');
        
        if ($request->hasFile('fotoPersonal')) {
            $input['fotoPersonal']=$request->file('fotoPersonal')->store('uploads', 'public');
        }

        Empleado::insert($input);
        
        return redirect('empleado');
    }

    
    public function show($id)
    {
        $empleado = Empleado::select(
            'empleado.*',
            'cargo.nombre_cargo as nombreCargo',
            'genero.NombreGenero as nombreGenero',
            'ciudad.nombreCiudad as nombreCiudad'
        )
       ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
       ->join('genero', 'empleado.genero_id', '=', 'genero.id')
       ->join('ciudad', 'empleado.ciudad_id', '=', 'ciudad.id')
       ->where('empleado.id', $id)
       ->first();

        $genero = Genero::all();
        $ciudad = Ciudad::all();
        $cargo = Cargo::all();

        return view('empleado.mostrar', compact('empleado', 'genero', 'ciudad', 'cargo'));
    }

   
    public function edit($id)
    {
        $empleado = Empleado::select(
            'empleado.*',
            'cargo.nombre_cargo as nombreCargo',
            'genero.NombreGenero as nombreGenero',
            'ciudad.nombreCiudad as nombreCiudad'
        )
       ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
       ->join('genero', 'empleado.genero_id', '=', 'genero.id')
       ->join('ciudad', 'empleado.ciudad_id', '=', 'ciudad.id')
       ->where('empleado.id', $id)
       ->first();

        $genero = Genero::all();
        $ciudad = Ciudad::all();
        $cargo = Cargo::all();

   
        return view('empleado.modificar', compact('empleado', 'genero', 'ciudad', 'cargo'));
    }

    
    public function update(Request $request)
    {
        $id = $request  -> id;
        $campos = [
            'numero_identificacion'=> 'required|max:11|unique:empleado,numero_identificacion,'.$id,
            'nombre'               => 'required|string|max:45',
            'apellido'             => 'required|string|max:45',
            'direccion'            => 'required|string|max:45',
            'numero_contacto'      => 'required|max:11',
            'correo_electronico'   => 'required|email|max:45|unique:empleado,correo_electronico,'.$id,
            'social_security'      => 'required|max:11|unique:empleado,social_security,'.$id,
            'cargo_id'             => 'required|max:11',
            'ciudad_id'            => 'required|max:11',
            'genero_id'            => 'required|max:11',
            'fotoPersonal'         => 'mimes:jpeg,png,jpg,gif'
        ];

        $mensaje = [
            'required' => 'The field :attribute is required',
            'mimes'    => 'Enter another format for the :attribute',
            'max'      => 'Enter a shorter value for :attribute',
            'unique'    => 'The :attribute already exist, enter a different one.',
            'email'    => 'Enter a valid email.'
        ];

        $this->validate($request, $campos, $mensaje);

        $input=request()->except('_token');

        if ($request->hasFile('fotoPersonal')) {
            $empleado = Empleado::find($id);

            Storage::delete('public/'.$empleado->fotoPersonal);

            $input['fotoPersonal']=$request->file('fotoPersonal')->store('uploads', 'public');
        }

        Empleado::where('id', '=', $id)->update($input);

        $empleado = Empleado::find($id);
        
        return redirect('empleado');
    }

    
    
    public function destroy(Request $request)
    {
        $id=$request->id;

        $empleado = Empleado::find($id);
        $empleado->update([
                'estado' => $empleado->estado == 1 ? 0 : 1,
            ]);

        return response()->json([
                'mensaje' => $empleado->estado == 1 ? 'Employee activated successfully' : 'Employee successfully desactivated',
            ]);
    }
}
