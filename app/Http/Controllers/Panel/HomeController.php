<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
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

        return view('panel.index', compact('clientes'));
    }
}
