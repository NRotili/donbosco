<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Venta;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:panel.home')->only('index');
    }

    public function index()
    {
        $clientes = Cliente::whereMonth('fechanacimiento', Carbon::now()->format('m'))
            ->whereDay('fechanacimiento', Carbon::now()->format('d'))->get();


        $ventaHoy = Venta::whereYear('created_at', Carbon::now()->format('Y'))
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->whereDay('created_at', Carbon::now()->format('d'))
            ->sum('total');

        $ventaMes = Venta::whereMonth('created_at', Carbon::now()->format('m'))
            ->sum('total');

        $ventaAnual = Venta::whereYear('created_at', Carbon::now()->format('Y'))
            ->sum('total');
        
        return view('panel.index', compact('clientes','ventaHoy', 'ventaMes', 'ventaAnual'));
    }
}
