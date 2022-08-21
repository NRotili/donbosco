<?php

namespace App\Http\Controllers\Panel\Administracion\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:panel.administracion.ventas.index')->only('index');
        $this->middleware('can:panel.administracion.ventas.show')->only('show');
        $this->middleware('can:panel.administracion.ventas.create')->only('create','store');
        $this->middleware('can:panel.administracion.ventas.edit')->only('edit', 'update');
        $this->middleware('can:panel.administracion.ventas.destroy')->only('destroy');
    }
   
    public function index()
    {
        return view('panel.administracion.ventas.index');
    }



    public function create()
    {
        return view('panel.administracion.ventas.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        return view('panel.administracion.ventas.show', compact('venta'));
    }

  
    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}
