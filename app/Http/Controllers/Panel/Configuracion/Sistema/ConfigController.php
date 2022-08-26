<?php

namespace App\Http\Controllers\Panel\Configuracion\Sistema;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Rules\PhoneNumber;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:panel.configuracion.sistema.index')->only('index');
        $this->middleware('can:panel.configuracion.sistema.show')->only('show');
        $this->middleware('can:panel.configuracion.sistema.create')->only('create','store');
        $this->middleware('can:panel.configuracion.sistema.edit')->only('edit', 'update');
        $this->middleware('can:panel.configuracion.sistema.destroy')->only('destroy');
    }

    public function index()
    {
        $config = Config::first();
        return view('panel.configuracion.sistema.index', compact('config'));
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    public function edit(Config $sistema)
    {
        return view('panel.configuracion.sistema.edit', compact('sistema'));
    }

   
    public function update(Request $request, Config $sistema)
    {
        $request->validate([
            'whatsapp' => ['nullable', new PhoneNumber],
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'email' => 'nullable|email',
            'porcentajePuntos' => 'nullable|integer|min:0',
            'stockBajo' => 'nullable|integer|min:0',
            'stockAlto' => 'nullable|integer|gt:stockBajo',
        ]);

        $sistema->update($request->all());
        return redirect()->route('panel.configuraciones.sistema.index')->with('info', 'Sistema actualizado exitosamente.');

    }

   
    public function destroy($id)
    {
        //
    }
}
