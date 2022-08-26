<?php

namespace App\Http\Controllers\Panel\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:panel.configuracion.roles.index')->only('index');
        $this->middleware('can:panel.configuracion.roles.show')->only('show');
        $this->middleware('can:panel.configuracion.roles.create')->only('create','store');
        $this->middleware('can:panel.configuracion.roles.edit')->only('edit', 'update');
        $this->middleware('can:panel.configuracion.roles.destroy')->only('destroy');
    }

    public function index()
    {
        $roles = Role::all();
        return view('panel.configuracion.roles.index', compact('roles'));
    }
    
    public function create()
    {
        $permissions = Permission::orderBy('description', 'asc')->get();
        return view('panel.configuracion.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $role = Role::create($request->all());

        $role->permissions()->sync($request->permissions);

        return redirect()->route('panel.configuracion.roles.index', $role)->with('info', 'Rol generado exitosamente');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('description', 'asc')->get();
        return view('panel.configuracion.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('panel.configuracion.roles.index', $role)->with('info', 'Rol actualizado exitosamente');
  
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('panel.configuracion.roles.index', $role)->with('info', 'Rol eliminado exitosamente');

    }
}
