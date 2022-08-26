<?php

namespace App\Http\Livewire\Panel\Administracion\Productos;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosIndex extends Component
{
    use WithPagination;

    //Filtro
    public $codigo, $nombre, $detalle;
    //Modal
    public $idModal, $titleModal,$stockModal, $stock;
    protected $paginationTheme = "bootstrap";

    public function render()
    {

        $productos = Producto::where('codigo', 'LIKE' , '%' . $this->codigo . '%')
                    ->where('nombre', 'LIKE', '%' . $this->nombre . '%')
                    ->where('detalle', 'LIKE', '%' . $this->detalle . '%')
                    ->orderBy('nombre')
                    ->paginate(15);

        return view('livewire.panel.administracion.productos.productos-index', compact('productos'));
    }

    public function editStock($id)
    {

        $producto = Producto::findOrFail($id);

        $this->idModal = $producto->id;
        $this->titleModal = $producto->nombre;
        $this->stockModal = $producto->stock;
    }

    public function updateStock($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->stock += $this->stock;
        $producto->update();

        $this->resetInput();
        $this->render();

        toastr()->title('Información')
                    ->info('Stock actualizado')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
    }

    public function resetInput()
    {
        $this->idModal = '';
        $this->titleModal = '';
        $this->stock = '';
        $this->stockModal = '';
    }
}
