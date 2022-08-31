<?php

namespace App\Http\Controllers\Panel\Administracion\Ventas;

use App\Http\Controllers\Controller;
use App\Models\ProductoVenta;
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

 
    public function destroy(Venta $venta)
    {
        if ($venta->status == 1) {
            $venta->update([
                'status'=> 0,
            ]);

            
            //Deshabilito venta_producto en pivote y aumento stock de los productos.
            foreach ($venta->productos as $producto) {
                $venta->productos()->updateExistingPivot([$producto->id], ['status' => 0]);
                if (!$producto->combo) {
                    $producto->stock += $producto->pivot->cantidad;
                    $producto->update();
                    
                } else {
                    foreach ($producto->contproductos as $productocbo) {
                        $productocbo->stock += $productocbo->pivot->cantidad * $producto->pivot->cantidad;
                        $productocbo->update();
                    }
                }  
            }
            // return redirect()->route('panel.administracion.ventas.index')->with('success', 'La venta se dió de baja.');
        } else {
            $venta->update([
                'status'=> 1,
            ]);
            //Habilito venta_producto en pivote y decremento stock de los productos.
            foreach ($venta->productos as $producto) {
                $venta->productos()->updateExistingPivot([$producto->id], ['status' => 1]);
                if (!$producto->combo) {
                    $producto->stock -= $producto->pivot->cantidad;
                    $producto->update();
                    
                } else {


                    foreach ($producto->contproductos as $productocbo) {
                        $productocbo->stock -= $productocbo->pivot->cantidad * $producto->pivot->cantidad;
                        $productocbo->update();

                    }
                }  
            }
            // return redirect()->route('panel.administracion.ventas.index')->with('success', 'La venta se dió de alta.');
        }
    }
}
