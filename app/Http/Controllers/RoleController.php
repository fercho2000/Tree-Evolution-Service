<?php

namespace App\Http\Controllers;

use App\Model\permission_role;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $roles = Role::paginate(10);
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        
        return view('roles.create', compact('permissions'));
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
            'name' => 'required|max:45|unique:roles',
            'slug' => 'required|max:45|unique:roles',
            'description' => 'max:500',
        ];
        $this->validate($request, $validator);

        $role = Role::create($request->all());
        
        $role->permissions()->sync($request->get('permissions'));
        
        return redirect()->route('roles.index', $role->id)
            ->with('info', 'Roles guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(role $role)
    {
        $permissions = Permission::get();

        $permisos = Permission::select('permissions.id')
        ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
        ->join('roles', 'permission_role.role_id', '=', 'roles.id')
        ->where('roles.id', $role->id)
        ->get();
        $arr=array();
        foreach ($permisos as $id) {
            array_push($arr, $id->id);
        }

        return view('roles.show', compact('role', 'permissions', 'arr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        $permissions = Permission::get();

        $permisos = Permission::select('permissions.id')
        ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
        ->join('roles', 'permission_role.role_id', '=', 'roles.id')
        ->where('roles.id', $role->id)
        ->get();
        $arr=array();
        foreach ($permisos as $id) {
            array_push($arr, $id->id);
        }

        return view('roles.edit', compact('role', 'permissions', 'arr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $role)
    {
        $validator = [
            'name' => 'required|max:45|unique:roles,name,'.$role->id,
            'slug' => 'required|max:45|unique:roles,slug,'.$role->id,
            'description' => 'max:500',
        ];
        $this->validate($request, $validator);
        
        $role->update($request->all());

        $role->permissions()->sync($request->get('permissions'));


        return redirect()->route('roles.index', $role->id)
            ->with('info', 'Roles actualizar con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
        $role->delete();

        return back()->with('info', 'Cliente eliminado correctamente');
    }
}
