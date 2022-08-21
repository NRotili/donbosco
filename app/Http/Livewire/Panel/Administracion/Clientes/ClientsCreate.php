<?php

namespace App\Http\Livewire\Panel\Administracion\Clientes;

use App\Models\Provincia;
use Livewire\Component;

class ClientsCreate extends Component
{
    public $province;

    public function updatingProvincia()
    {
        $this->resetPage();
    }

    public function render()
    {

        $provincias = Provincia::orderBy('nombre')->pluck('nombre', 'id');

        if ($this->province) {
            $ciudades = Provincia::find($this->province)
                ->ciudades
                ->pluck('nombre', 'id');
        } else {
            $ciudades = [];
        }

        return view('livewire.panel.administracion.clientes.clients-create', compact('provincias', 'ciudades'));
    }
}
