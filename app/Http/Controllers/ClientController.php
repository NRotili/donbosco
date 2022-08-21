<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Config;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index($qr)
    {
        $config = Config::first();
        $cliente = Cliente::where('qr', $qr)->firstOrFail();
        return view('client', compact('cliente','config'));
    }
}
