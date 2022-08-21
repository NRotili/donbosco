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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.administracion.productos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.administracion.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        // $producto = Producto::findOrFail($id);
        return view('panel.administracion.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
