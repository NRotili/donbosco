<?php

namespace App\Http\Livewire\Panel\Administracion\Productos;

use App\Models\ComboProducto;
use App\Models\Producto;
use Livewire\Component;

class ProductosCreate extends Component
{

    public $codigo, $nombre, $detalle, $preciocosto, $preciolista, $preciohappyhour, $combo = false, $stock;
    public $comboProducts = [];
    public $productos, $cantidad;


    public $product_id, $itemtotal;
    // public $cliente_id;
    // public $selected_id, $search;
    // public $clientes, $cliente;
    // public $action = 1;
    // public $total = 0;
    // public $checkHH;
    // public $itemCostos;



    public function render()
    {

        $this->productos = Producto::where('status','1')
                            ->where('combo', '0')
                            ->get();

        return view('livewire.panel.administracion.productos.productos-create', ['productos' => $this->productos]);
        
    }
    public function doAction($action)
    {
        $this->selected_id = $action;
    }

    public function resetInput()
    {
        $this->product_id = '';
        $this->cantidad = null;
    }

    public function addProduct()
    {
        if ($this->product_id == '' || $this->cantidad == '') {
            toastr()->title('Validación de campos')
                    ->error('Seleccione un producto')
                    ->timeOut(3000)
                    ->progressBar()
                    ->flash();
        
        } else {
            $product = Producto::find($this->product_id);
            $name = $product->nombre;

            $this->preciocosto += $product->preciocosto * $this->cantidad;

            $comboProducts = array(
                'product_id' => $this->product_id,
                'name' => $name,
                'cantidad' => $this->cantidad,
                'itemtotal' => $product->preciocosto * $this->cantidad
                 );
            $this->comboProducts[] = $comboProducts;
            toastr()->title('Información')
                    ->info('Producto añadido')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();

            $this->resetInput();
        }
    }

    public function removeItem($key)
    {
        $this->preciocosto -= $this->comboProducts[$key]['itemtotal'];
        unset($this->comboProducts[$key]);
        toastr()->title('Información')
                    ->info('Producto eliminado')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
    }

    public function storeOrder()
    {
        if ($this->nombre == '' || $this->preciocosto == '' || $this->preciolista == '' || $this->preciohappyhour == '') {
            toastr()->title('Validación de campos')
                    ->error('Hay campos obligatorios sin completar')
                    ->timeOut(3000)
                    ->progressBar()
                    ->flash();
        }

        $this->validate([
            'nombre' => 'required',
            'preciocosto' => 'required',
            'preciolista' => 'required',
            'preciohappyhour' => 'required',
        ]);

        if($this->codigo == null){
            $this->codigo = '-';
        }

        if($this->detalle == null){
            $this->detalle = '-';
        }
        
        if(!$this->combo){

            $results = array(
                'codigo' => $this->codigo,
                'nombre' => $this->nombre,
                'detalle' => $this->detalle,
                'preciocosto' => $this->preciocosto,
                'preciolista' => $this->preciolista,
                'preciohappyhour' => $this->preciohappyhour,
                'combo' => 0,
                'stock' => $this->stock,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            );

            Producto::create($results);

            toastr()->title('Información')
                ->success('Producto creado')
                ->timeOut(3000)
                ->progressBar()
                ->flash();
                
            return redirect()->route('panel.administracion.productos.index');
        } else {
            $results = array(
                'codigo' => $this->codigo,
                'nombre' => $this->nombre,
                'detalle' => $this->detalle,
                'preciocosto' => $this->preciocosto,
                'preciolista' => $this->preciolista,
                'preciohappyhour' => $this->preciohappyhour,
                'combo' => 1,
                'stock' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            );

            $producto = Producto::create($results);

            foreach ($this->comboProducts as $key => $product) {
    
                $results = array(
                    'combo_id' => $producto->id,
                    'producto_id' => $product['product_id'],
                    'cantidad' =>$product['cantidad'],
                    'created_at' => now(),
                    'updated_at' => now()
                );    
                ComboProducto::insert($results);
            }


            toastr()->title('Información')
                ->success('Combo creado')
                ->timeOut(3000)
                ->progressBar()
                ->flash();
                
            return redirect()->route('panel.administracion.productos.index');
        }
       
    }
}
