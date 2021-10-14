<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Empleado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select('*')->where('users.id', $id)->first();

        $empleado = Empleado::select('empleado.*')
        ->join('users', 'users.empleado_id', '=', 'empleado.id')
        ->where('users.id', $id)
        ->first();

        return view('config.index', compact('user', 'empleado'));
    }

    public function userupdate(Request $request, User $user)
    {
        $validator = [
            'name' => 'required|max:45',
            'email' => 'required|max:60|unique:users,email,'.$user->id,

        ];
        $this->validate($request, $validator);
        
        $user->update($request->all());
        
        return redirect()->route('config.index');
    }

    // public function contrasenaupdate(Request $request, User $user)
    // {


    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //     ]);
         
    //     $update = ['password' => $request->password];
    //     Note::where('id',$user->id)->update($update);
   
    //     return redirect()->route('config.index');

        
    // }

    public function empupdate(Request $request, $id)
    {
        $campos = [
            'direccion'            => 'required|string|max:45',
            'numero_contacto'      => 'required|max:11',
            'correo_electronico'   => 'required|email|max:45',
        ];

        $mensaje = [
            'required' => 'El campo :attribute es requerido',
            'max'      => 'Ingrese un valor más corto para :attribute'
        ];

        $this->validate($request, $campos, $mensaje);

        $input=request()->except('_token');

        Empleado::where('id', '=', $id)->update($input);

        return redirect()->route('config.index');
    }

    public function fotoupdate(Request $request, $id)
    {
        $empleado = Empleado::select('empleado.*')
        ->where('empleado.id', $id)
        ->first();
        $campos = [
            'fotoPersonal' => 'mimes:jpeg,png,jpg,gif'
        ];

        $mensaje = [
            'mimes' => 'this format is not valid, try again.'
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

        return redirect()->route('config.index');
    }
}
