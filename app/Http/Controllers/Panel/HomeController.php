<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Config;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:panel.home')->only('index');
    }

    public function index()
    {
        $config = Config::first();
        $clientes = Cliente::whereMonth('fechanacimiento', Carbon::now()->format('m'))
            ->whereDay('fechanacimiento', Carbon::now()->format('d'))->get();

        if(Carbon::now()->format('H') <= 6){
            $ventaHoy = Venta::where('status', 1)
            ->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d') . " 06:00:01", Carbon::now()->format('Y-m-d') . " 06:00:00"])
            ->sum('total');
        }else{
            $ventaHoy = Venta::where('status', 1)
            ->whereBetween('created_at', [Carbon::now()->format('Y-m-d') . " 06:00:01", Carbon::tomorrow()->format('Y-m-d') . " 06:00:00"])
            ->sum('total');
        }


        $ventaMes = Venta::whereMonth('created_at', Carbon::now()->format('m'))
            ->sum('total');

        $ventaAnual = Venta::whereYear('created_at', Carbon::now()->format('Y'))
            ->sum('total');

        $productosBajoStock = Producto::where('status', 1)
            ->where('combo', false)
            ->where('stock', '<=', $config->stockBajo)
            ->orderBy('nombre')
            ->get();

        $productosAltoStock = Producto::where('status', 1)
            ->where('combo', false)
            ->where('stock', '>=', $config->stockAlto)
            ->orderBy('nombre')
            ->get();

        $topsales = DB::table('producto_venta')
            ->leftJoin('productos', 'productos.id', '=', 'producto_venta.producto_id')
            ->select(
                'productos.id',
                'productos.nombre',
                'producto_venta.producto_id',
                DB::raw('SUM(producto_venta.cantidad) as total')
            )
            ->groupBy('productos.id', 'producto_venta.producto_id', 'productos.nombre')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('panel.index', compact('clientes', 'ventaHoy', 'ventaMes', 'ventaAnual', 'productosBajoStock', 'productosAltoStock', 'topsales'));
    }
}
