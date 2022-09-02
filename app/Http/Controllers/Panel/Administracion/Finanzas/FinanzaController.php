<?php

namespace App\Http\Controllers\Panel\Administracion\Finanzas;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinanzaController extends Controller
{
    public function index()
    {

        if(Carbon::now()->format('H') <= 6){
            $ventaHoy = Venta::where('status', 1)
            ->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d') . " 06:00:01", Carbon::now()->format('Y-m-d') . " 06:00:00"])
            ->sum('subtotal');
            $remanenteHoy = ProductoVenta::where('status', 1)
            ->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d') . " 06:00:01", Carbon::now()->format('Y-m-d') . " 06:00:00"])
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));
        }else{
            $ventaHoy = Venta::where('status', 1)
            ->whereBetween('created_at', [Carbon::now()->format('Y-m-d') . " 06:00:01", Carbon::tomorrow()->format('Y-m-d') . " 06:00:00"])
            ->sum('subtotal');
            $remanenteHoy = ProductoVenta::where('status', 1)
            ->whereBetween('created_at', [Carbon::now()->format('Y-m-d') . " 06:00:01", Carbon::tomorrow()->format('Y-m-d') . " 06:00:00"])
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));

        }

        $ventaMes = Venta::where('status', 1)
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->sum('subtotal');
        $remanenteMes = ProductoVenta::where('status', 1)
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));


        $ventaAnual = Venta::where('status', 1)
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->sum('subtotal');
        $remanenteAnual = ProductoVenta::where('status', 1)
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));

        $productos = Producto::where('status', 1)->where('combo',0)->where('stock', '>',0)->get();

        $capital = 0;

        foreach ($productos as $producto) {
            $capital += $producto->stock * $producto->preciocosto;
        }

        return view('panel.administracion.finanzas.index', compact('ventaHoy', 'ventaMes', 'ventaAnual', 'capital', 'remanenteHoy', 'remanenteMes', 'remanenteAnual'));
    }
}
