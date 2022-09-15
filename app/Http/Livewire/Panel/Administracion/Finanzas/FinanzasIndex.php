<?php

namespace App\Http\Livewire\Panel\Administracion\Finanzas;

use App\Models\Mediopago;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FinanzasIndex extends Component
{

    public $ventaHoy, $remanenteHoy, $ventaMes, $remanenteMes, $ventaAnual, $remanenteAnual, $capital, $mediosPagos;

    //Medio seleccionado (Ganancias)
    public $medioSelectedHoy, $medioSelectedMes, $medioSelectedAnual;
    //Fecha seleccionada (Ganancias)
    public $dateGananciaHoy, $dateGananciaMes, $dateGananciaAño;
    public $años;

    public function mount()
    {
        
        $this->años = Venta::select(DB::raw('YEAR(created_at) AS año'))
        ->groupBy('año')
        ->orderByDesc('año')
        ->pluck('año');
        
        $this->dateGananciaHoy = Carbon::now()->format('Y-m-d');
        $this->dateGananciaMes = Carbon::now()->format('Y-m');
        $this->dateGananciaAño = Carbon::now()->format('Y');
        
        if(Carbon::now()->format('H') <= 6){
            $this->remanenteHoy = ProductoVenta::where('status', 1)
            ->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d') . " 06:00:01", Carbon::now()->format('Y-m-d') . " 06:00:00"])
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));
        }else{
            $this->remanenteHoy = ProductoVenta::where('status', 1)
            ->whereBetween('created_at', [Carbon::now()->format('Y-m-d') . " 06:00:01", Carbon::tomorrow()->format('Y-m-d') . " 06:00:00"])
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));
        }

 
        $this->remanenteMes = ProductoVenta::where('status', 1)
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));


        $this->remanenteAnual = ProductoVenta::where('status', 1)
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->sum(DB::raw('(preciovendido-preciocosto)*cantidad'));

        $this->productos = Producto::where('status', 1)->where('combo',0)->where('stock', '>',0)->get();

        $this->capital = 0;

        foreach ($this->productos as $producto) {
            $this->capital += $producto->stock * $producto->preciocosto;
        }

        $this->mediosPagos = Mediopago::orderBy('nombre')->get();

    }

    public function render()
    {
        if(Carbon::now()->format('H') <= 6){
            $this->ventaHoy = Venta::where('status', 1)
            ->where('mediopago_id', 'LIKE', '%'.$this->medioSelectedHoy.'%')
            ->whereBetween('created_at', [Carbon::parse($this->dateGananciaHoy)->subDays(1)->format('Y-m-d') . " 06:00:01", $this->dateGananciaHoy . " 06:00:00"])
            // ->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d') . " 06:00:01", Carbon::now()->format('Y-m-d') . " 06:00:00"])
            ->sum('subtotal');
        }else{
            $this->ventaHoy = Venta::where('status', 1)
            ->where('mediopago_id', 'LIKE', '%'.$this->medioSelectedHoy.'%')
            ->whereBetween('created_at', [$this->dateGananciaHoy . " 06:00:01", Carbon::parse($this->dateGananciaHoy)->addDays(1)->format('Y-m-d') . " 06:00:00"])
            // ->whereBetween('created_at', [Carbon::now()->format('Y-m-d') . " 06:00:01", Carbon::tomorrow()->format('Y-m-d') . " 06:00:00"])
            ->sum('subtotal');
        }

        $this->ventaMes = Venta::where('status', 1)
        ->whereMonth('created_at', Carbon::parse($this->dateGananciaMes)->format('m'))
        ->whereYear('created_at', Carbon::parse($this->dateGananciaMes)->format('Y'))
        ->where('mediopago_id', 'LIKE', '%'.$this->medioSelectedMes.'%')
        ->sum('subtotal');

        $this->ventaAnual = Venta::where('status', 1)
        ->whereYear('created_at', $this->dateGananciaAño)
        ->where('mediopago_id', 'LIKE', '%'.$this->medioSelectedAnual.'%')
        ->sum('subtotal');

  
        return view('livewire.panel.administracion.finanzas.finanzas-index');
    }


}
