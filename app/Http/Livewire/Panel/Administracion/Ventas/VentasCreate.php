<?php

namespace App\Http\Livewire\Panel\Administracion\Ventas;

use App\Models\Cliente;
use App\Models\Config;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Livewire\Component;
use Flasher\Toastr\Prime\ToastrFactory;


class VentasCreate extends Component
{

    public $product_id, $cantidad, $preciolista, $preciohappyhour, $subtotal = 0, $itemtotal;
    public $cliente_id;
    public $selected_id, $search;
    public $clientes, $cliente, $productos;
    public $orderProducts = [];
    public $action = 1;
    public $total = 0;
    public $checkHH;
    public $itemCostos;
    public $puntos;
    public $isDisabledLista;
    public $isDisabledHH;
    public $error;
    public $porcentajeFormula;

    public function render()
    {
        $this->productos = Producto::where('status','1')->orderBy('nombre')->get();
        $this->clientes = Cliente::where('habilitado','1')->orderBy('apellido')->orderBy('nombre')->get();
       
        $this->porcentajeFormula = Config::first();

        if($this->checkHH){
            $this->isDisabledLista=true;
            $this->isDisabledHH=false;
        } else {
            $this->isDisabledLista=false;
            $this->isDisabledHH=true;
        }

        if ($this->product_id != null) {
            $this->itemCostos = Producto::findOrFail($this->product_id);
            $this->preciohappyhour = $this->itemCostos->preciohappyhour;
            $this->preciolista = $this->itemCostos->preciolista;
        }

        if ($this->selected_id > 0) {
            $this->cliente = Cliente::find($this->selected_id);
            $this->cliente_id = $this->cliente->id;
            return view('livewire.panel.administracion.ventas.ventas-create', [
                'productos' => $this->productos,
                'cliente' => $this->cliente,
                'orderProducts' => $this->orderProducts,
            ]);
        } else {
            return view('livewire.panel.administracion.ventas.ventas-create', [
                'productos' => $this->productos,
                'clientes' => $this->clientes,
                'orderProducts' => $this->orderProducts,
            ]);
        }
    }
    public function doAction($action)
    {
        $this->selected_id = $action;
    }

    public function resetInput()
    {
        $this->product_id = '';
        $this->cantidad = null;
        $this->preciolista = null;
        $this->preciohappyhour = null;
    }

    public function addProduct()
    {
        $this->error = 0;
        if ($this->product_id == '' || $this->cantidad == '' || $this->preciolista == '' || $this->preciohappyhour == '') {
            toastr()->title('Validación de campos')
                    ->error('Complete todos los campos')
                    ->timeOut(3000)
                    ->progressBar()
                    ->flash();
            $this->error = 1;
        } elseif ($this->itemCostos->combo) {
            foreach ($this->itemCostos->contproductos as $productocombo) {
                if ($productocombo->stock < ($productocombo->pivot->cantidad * $this->cantidad)) {
                    toastr()->title('Comprobación de stock')
                    ->error("Stock de $productocombo->nombre insuficiente.")
                    ->timeOut(3000)
                    ->progressBar()
                    ->flash();

                    $this->error = 1;
                }
            }
        } elseif (!$this->itemCostos->combo && ($this->itemCostos->stock < $this->cantidad)) {
            toastr()->title('Comprobación de stock')
                    ->error('Stock insuficiente')
                    ->timeOut(3000)
                    ->progressBar()
                    ->flash();
            $this->error = 1;
        }
        
        if($this->error == 0){
            $product = Producto::find($this->product_id);
            $name = $product->nombre;
            if ($this->checkHH == 1) {
                $this->itemtotal = floatval($this->cantidad) * floatval($this->preciohappyhour);
            } else {
                $this->itemtotal = floatval($this->cantidad) * floatval($this->preciolista);
            }
            $this->subtotal = floatval($this->subtotal) + floatval($this->itemtotal);
            $this->total = $this->subtotal;

 
            $this->puntos = intval(($this->porcentajeFormula->porcentajePuntos * $this->total) / 100);

            $orderProducts = array(
                'product_id' => $this->product_id,
                'name' => $name,
                'cantidad' => $this->cantidad,
                'preciolista' => $this->preciolista,
                'preciohappyhour' => $this->preciohappyhour,
                'itemtotal' => $this->itemtotal
            );
            $this->orderProducts[] = $orderProducts;
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
        $this->subtotal = $this->subtotal - $this->orderProducts[$key]['itemtotal'];
        $this->total = $this->subtotal;
        
        $this->puntos = intval((10 *$this->total) /100);
        unset($this->orderProducts[$key]);
        toastr()->title('Información')
                    ->info('Producto eliminado')
                    ->timeOut(2000)
                    ->progressBar()
                    ->flash();
    }

    public function storeOrder()


    {
        if ($this->cliente_id == '') {
            toastr()->title('Validación de campos')
                    ->error('Seleccione un cliente')
                    ->timeOut(3000)
                    ->progressBar()
                    ->flash();
        }

        $this->validate([
            'cliente_id' => 'required',
        ]);


        $order = Venta::create([
            'total' => $this->total,
            'cliente_id' => $this->cliente_id
        ]);

        foreach ($this->orderProducts as $key => $product) {
            $item = Producto::find($product['product_id']);
            
            $results = array(
                'producto_id' => $product['product_id'],
                'venta_id' => $order->id,
                'preciocosto' => $item->preciocosto,
                'preciovendido' => $product['itemtotal'] / $product['cantidad'],
                'cantidad' => $product['cantidad'],
                'created_at' => now(),
                'updated_at' => now()
            );


            ProductoVenta::insert($results);

            if (!$item->combo) {
                $item->stock -= $product['cantidad'];
                $item->update();
            } else {
                foreach ($item->contproductos as $producto) {
                    $producto->stock -= $producto->pivot->cantidad * $product['cantidad'];
                    $producto->update();
                }
            }
            
        }

        $cliente = Cliente::findOrFail($this->cliente_id);
        $cliente->puntos += intval(($this->porcentajeFormula->porcentajePuntos *$this->total) /100);
        $cliente->update();

        toastr()->title('Información')
                ->success('Stock y puntos del cliente actualizados')
                ->timeOut(2000)
                ->progressBar()
                ->flash();

        toastr()->title('Información')
                ->success('Venta generada')
                ->timeOut(3000)
                ->progressBar()
                ->flash();
                
        return redirect()->route('panel.administracion.ventas.index');
    }
}