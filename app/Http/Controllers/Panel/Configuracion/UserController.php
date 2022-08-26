<?php

namespace App\Http\Controllers\Panel\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:panel.configuracion.users.index')->only('index');
        $this->middleware('can:panel.configuracion.users.show')->only('show');
        $this->middleware('can:panel.configuracion.users.create')->only('create','store');
        $this->middleware('can:panel.configuracion.users.edit')->only('edit', 'update');
        $this->middleware('can:panel.configuracion.users.destroy')->only('destroy');
    }
  
    public function index()
    {
        $users = User::paginate();
        return view('panel.configuracion.users.index', compact('users'));
    }

  
    public function create()
    {
        $roles = Role::all();
        return view('panel.configuracion.users.create', compact('roles'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $request['password'] = bcrypt($request->password);
        
        $user = User::create($request->all());

        $user->roles()->sync($request->roles);

        return redirect()->route('panel.configuracion.users.index', $user)->with('info', 'Usuario generado exitosamente');
 
    }

  
    public function show($id)
    {
        //
    }

 
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('panel.configuracion.users.edit', compact('user','roles'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|unique:users,email,$user->id",
        ]);

        if ($request->password == null){
            $user->update($request->except('password'));
        } else {
            $request['password'] = bcrypt($request->password);
            $user->update($request->all());
        }

        $user->roles()->sync($request->roles);
        return redirect()->route('panel.configuracion.users.index', $user)->with('info', 'Se actualizó el usuario correctamente');

    }

   
    public function destroy($id)
    {
        //
    }
}
