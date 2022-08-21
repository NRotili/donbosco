<?php

namespace App\Http\Livewire\Panel\Administracion\Clientes;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;


class ClientsIndex extends Component
{

    use WithPagination;

    public $nombre;
    public $telcelular;
    public $qr;
    public $apellido;

    public function updatingNombre()
    {
        $this->resetPage();
    }

    public function updatingTelcelular()
    {
        $this->resetPage();
    }

    public function updatingQr()
    {
        
        $this->resetPage();
    }

    public function updatingApellido()
    {
        $this->resetPage();
    }
    
    protected $paginationTheme = "bootstrap";

    public function render()
    {   
        if($this->qr){
            $qrcode = explode('/', $this->qr);
            if(isset($qrcode[1])){
                $this->qr = $qrcode[1];
            }
        }

        $clientes = Cliente::where('telcelular', 'LIKE' , '%' . $this->telcelular . '%')
        ->where('qr', 'LIKE' , '%' . $this->qr . '%')
        ->where('apellido', 'LIKE' , '%' . $this->apellido . '%')
        ->where('nombre', 'LIKE' , '%' . $this->nombre . '%')
        ->orderBy('apellido')
        ->orderBy('nombre')
        ->orderBy('habilitado')
        ->paginate();


        return view('livewire.panel.administracion.clientes.clients-index', compact('clientes'));
    }


}
