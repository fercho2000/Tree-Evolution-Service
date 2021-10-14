<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\empleado;
use APP\Model\User;
use App\Model\Genero;
use App\Model\Ciudad;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $user = Auth::user()->id;
        $foto = User::select('empleado.fotoPersonal')
        ->join('empleado', 'users.empleado_id', '=', 'empleado.id')
        ->where('users.id', $user)
        ->first();
        $countUser = User::count();

        return view('index2', compact('user', 'foto', 'countUser'));
    }

    public function perfil(User $user)
    {
        $userLog = Auth::user()->id;

        $users = User::select('users.*', 'empleado.*', 'ciudad.nombreCiudad as ciudad', 'genero.NombreGenero as genero', 'cargo.nombre_cargo as cargo')
        ->join('empleado', 'users.empleado_id', '=', 'empleado.id')
        ->join('genero', 'empleado.genero_id', '=', 'genero.id')
       ->join('ciudad', 'empleado.ciudad_id', '=', 'ciudad.id')
       ->join('cargo', 'empleado.cargo_id', '=', 'cargo.id')
        ->where('users.id', $userLog)
        ->first();
        
        $userss = User::select('users.name as nombre', 'users.estado as estado', 'users.email as email', 'roles.name as rol', 'roles.id as rolid')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->where('users.id', $userLog)
        ->first();

        $foto = User::select('empleado.fotoPersonal')
        ->join('empleado', 'users.empleado_id', '=', 'empleado.id')
        ->where('users.id', $userLog)
        ->first();
        

        return view('user_profile', compact('users', 'foto', 'userss'));
    }
}
