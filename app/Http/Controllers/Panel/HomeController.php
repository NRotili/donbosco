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
            ->where('producto_venta.status', 1)
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


        return view('panel.index', compact('clientes', 'productosBajoStock', 'productosAltoStock', 'topsales'));
    }
}
