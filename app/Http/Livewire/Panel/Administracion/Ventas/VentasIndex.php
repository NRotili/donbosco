<?php

namespace App\Http\Livewire\Panel\Administracion\Ventas;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;


class VentasIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $date;
    public $apellido;
    public $nombre;
    public $telcelular;
  
    public function updatingDate()
    {
        $this->resetPage();
    }
    public function render()
    {
        $ventas = Venta::where('created_at', 'LIKE', '%' . $this->date . '%')
            ->whereHas('cliente', function (Builder $query) {
            $query->where('apellido', 'LIKE' , '%' . $this->apellido . '%');
            $query->where('nombre', 'LIKE', '%' . $this->nombre . '%');
            $query->where('telcelular', 'LIKE', '%' . $this->telcelular . '%');

        })
  
        ->orderByDesc('created_at')
        ->paginate();
        
        return view('livewire.panel.administracion.ventas.ventas-index', compact('ventas'));
    }
}
