<?php

namespace App\Http\Controllers\Panel\Administracion\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:panel.administracion.clientes.index')->only('index');
        $this->middleware('can:panel.administracion.clientes.show')->only('show');
        $this->middleware('can:panel.administracion.clientes.create')->only('create','store');
        $this->middleware('can:panel.administracion.clientes.edit')->only('edit', 'update');
        $this->middleware('can:panel.administracion.clientes.destroy')->only('destroy');
    }

    public function index()
    {
        return view('panel.administracion.clientes.index');
    }


    public function create()
    {
        return view('panel.administracion.clientes.create' );
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'nullable|numeric|unique:clientes',
            'nombre' => 'required',
            'apellido' => 'required',
            'fechanacimiento' => 'required',
            'telfijo' => 'nullable|numeric',
            'telcelular' => 'numeric|required|unique:clientes',
            'email' => 'nullable|email',
        ]);

        $cliente = Cliente::create($request->all());
        $cliente->qr = md5($cliente->id);
        $cliente->update();
       
        

        return redirect()->route('panel.administracion.clientes.index')->with('success', 'Cliente añadido exitosamente.');;

    }


    public function show(Cliente $cliente)
    {
        return view('panel.administracion.clientes.show', compact('cliente'));

    }

   
    public function edit(Cliente $cliente)
    {
        return view('panel.administracion.clientes.edit', compact('cliente'));
    }


    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'dni' => "nullable|numeric|unique:clientes,dni,$cliente->id",
            'nombre' => 'required',
            'apellido' => 'required',
            'fechanacimiento' => 'required',
            'telfijo' => 'nullable|numeric',
            'telcelular' => "numeric|required|unique:clientes,telcelular,$cliente->id",
            'email' => 'nullable|email',
        ]);

        $cliente->update($request->all());
        return redirect()->route('panel.administracion.clientes.index')->with('success', 'Cliente actualizado exitosamente.');

    }


    public function destroy(Cliente $cliente)
    {
        if ($cliente->habilitado == 1) {
            $cliente->update([
                'habilitado'=> 0,
            ]);
            return redirect()->route('panel.administracion.clientes.index')->with('success', 'El cliente se dió de baja.');
        } else {
            $cliente->update([
                'habilitado'=> 1,
            ]);
            return redirect()->route('panel.administracion.clientes.index')->with('success', 'El cliente se dió de alta.');
        }
        
    }

    public function plus($id)
    {
        $cliente = Cliente::find($id);
        return view('panel.administracion.clientes.plus', compact('cliente'));
    }

    public function plusupdate(Request $request, Cliente $cliente)
    {
        
        $cliente->puntos += $request->puntos;
        $cliente->update();
        return view('panel.administracion.clientes.plus', compact('cliente'));
        
    }
}

