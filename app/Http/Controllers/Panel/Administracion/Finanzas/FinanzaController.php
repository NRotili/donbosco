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

        return view('panel.administracion.finanzas.index');
    }
}
