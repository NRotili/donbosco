<?php

namespace App\Http\Controllers\Panel\Administracion\Productos;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:panel.administracion.productos.index')->only('index');
        $this->middleware('can:panel.administracion.productos.show')->only('show');
        $this->middleware('can:panel.administracion.productos.create')->only('create','store');
        $this->middleware('can:panel.administracion.productos.edit')->only('edit', 'update');
        $this->middleware('can:panel.administracion.productos.destroy')->only('destroy');
    }

    public function index()
    {
        return view('panel.administracion.productos.index');
    }

    public function create()
    {
        return view('panel.administracion.productos.create');
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Producto $producto)
    {
        return view('panel.administracion.productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('panel.administracion.productos.edit', compact('producto'));
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Producto $producto)
    {
        if ($producto->status == 1) {
            $producto->update([
                'status'=> 0,
            ]);

            if($producto->combos){
                foreach ($producto->combos as $combo) {
                    $combo->status = 0;
                    $combo->update();
                }
            }

            return redirect()->route('panel.administracion.productos.index')->with('success', 'El producto se dió de baja.');
        } else {
            $producto->update([
                'status'=> 1,
            ]);

            return redirect()->route('panel.administracion.productos.index')->with('success', 'El producto se dió de alta.');
        }
    }
}
