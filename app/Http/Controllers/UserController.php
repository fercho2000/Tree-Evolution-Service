<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\role_user;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('users.*', 'roles.name as rol', 'roles.id as rolid')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->get();

        $id = Auth::user()->id;

        $counAdmin = role_user::selectRaw('count(*) as valor')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->where('roles.id', '=', 1)
        ->first();
        // dd($counAdmin);

        return view('users.index', compact('users', 'id', 'counAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        // dd($roles);
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = [
            'name' => 'required|max:45',
            'email' => 'required|max:60|unique:users',
            'password' => 'required|max:225',
            'roles' => 'required'
        ];
        $this->validate($request, $validator);
        

        $input = $request->all();
        $users = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);
        $users->roles()->sync($request->get('roles'));
        
        return redirect()->route('users.index')
            ->with('info', 'Usuario guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::get();
        
        $role_user = role_user::select('role_user.*', 'roles.name')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->where('role_user.user_id', $user->id)
        ->first();

        return view('users.show', compact('user', 'roles', 'role_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $id = Auth::user()->id;

        $roles = Role::get();

        $role_user = role_user::select('role_user.*', 'roles.name')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->where('role_user.user_id', $user->id)
        ->first();
        
        return view('users.edit', compact('user', 'roles', 'role_user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = [
            'name' => 'required|max:45',
            'email' => 'required|max:60|unique:users,email,'.$user->id,
            'roles' => 'required'

        ];

        $mensaje = [

            'unique' => 'El correo ya existe, ingrese uno diferente',
        ];
        $this->validate($request, $validator, $mensaje);
        
        $user->update($request->all());
        
        $user->roles()->sync($request->get('roles'));
        
        return redirect()->route('users.index', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info', 'User successfully deleted');
    }

    public function destroy2(Request $request)
    {
        $id=$request->id;

        $user = User::find($id);
        $user->update([
                'estado' => $user->estado == 1 ? 0 : 1,
            ]);
        return response()->json([
                'mensaje' => $user->estado == 1 ? 'User Activated Successfully' : 'User successfully deactivated',
            ]);
    }
}
