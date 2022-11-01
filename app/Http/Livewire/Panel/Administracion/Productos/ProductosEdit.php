<?php

namespace App\Http\Livewire\Panel\Administracion\Productos;

use App\Models\Categoria;
use App\Models\ComboProducto;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ProductosEdit extends Component
{

    //Recibo producto desde blade
    public $producto;
    //Creo atributos para formulario
    public $codigo, $nombre, $detalle, $combo, $preciocosto, $preciolista, $preciohappyhour, $stock;
    public $preciocostoanterior;
    public $comboProducts = [];
    public $productos, $cantidad;
    public $product_id, $itemtotal;

    public $categorias, $catSeleccionadas = [];

    public function mount()
    {

        $this->codigo = $this->producto->codigo;
        $this->nombre = $this->producto->nombre;
        $this->detalle = $this->producto->detalle;
        $this->combo = $this->producto->combo;
        $this->preciocosto = $this->producto->preciocosto;
        $this->preciocostoanterior = $this->producto->preciocosto;
        $this->preciolista = $this->producto->preciolista;
        $this->preciohappyhour = $this->producto->preciohappyhour;
        $this->stock = $this->producto->stock;

        $this->catSeleccionadas = $this->producto->categorias->pluck('id');
        
        if ($this->combo) {
            foreach ($this->producto->contproductos as $productoCombo) {
                $comboProducts = array(
                    'product_id' => $productoCombo->id,
                    'name' => $productoCombo->nombre,
                    'cantidad' => $productoCombo->pivot->cantidad,
                    'itemtotal' => $productoCombo->preciocosto * $productoCombo->pivot->cantidad
                );

                $this->comboProducts[] = $comboProducts;
            }
        }
    }

    public function render()
    {
        $this->categorias = Categoria::where('status', 1)->orderBy('nombre')->get();     

        $this->productos = Producto::where('status', '1')
            ->where('combo', '0')
            ->get();

        return view('livewire.panel.administracion.productos.productos-edit');
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

    public function resetInput()
    {
        $this->product_id = '';
        $this->cantidad = null;
    }

    public function updateProduct()
    {
        
        if($this->codigo == null){
            $this->codigo = '-';
        }

        if($this->detalle == null){
            $this->detalle = '-';
        }

        if(!$this->combo){
            
            $validatedData = Validator::make(
                [
                    'nombre' => $this->nombre,
                    'precioCosto' => $this->preciocosto,
                    'precioLista' => $this->preciolista,
                    'precioHappyHour' => $this->preciohappyhour,
                    'stock' => $this->stock
                ],
                [
                    'nombre' => 'required',
                    'precioCosto' => 'required|numeric|min:0|lte:precioLista|lte:precioHappyHour',
                    'precioLista' => 'required|numeric|gte:precioCosto',
                    'precioHappyHour' => 'required|numeric|gte:precioCosto',
                    'stock' => 'required|numeric|min:0'
                ],
            );
    
            if ($validatedData->fails()) {
                toastr()->title('Validación...')
                    ->error('Hay errores en los campos.')
                    ->timeOut(3000)
                    ->progressBar()
                    ->flash();
            }
    
            $validatedData->validate();

            $this->producto->codigo = $this->codigo;
            $this->producto->nombre = $this->nombre;
            $this->producto->detalle = $this->detalle;
            $this->producto->preciocosto = $this->preciocosto;
            $this->producto->preciolista = $this->preciolista;
            $this->producto->preciohappyhour = $this->preciohappyhour;
            $this->producto->combo = $this->combo;
            $this->producto->stock = $this->stock;
            $this->producto->updated_at = now();

            $this->producto->update();
            $this->producto->categorias()->sync($this->catSeleccionadas);

            if ($this->preciocostoanterior != $this->preciocosto) {
                foreach ($this->producto->combos as $productoCbo) {
                    $productoCbo->preciocosto -= $this->preciocostoanterior*$productoCbo->pivot->cantidad;
                    $productoCbo->preciocosto += $this->preciocosto*$productoCbo->pivot->cantidad;
                    $productoCbo->update();
                }
                toastr()->title('Información')
                ->success('Combos actualizados')
                ->timeOut(3000)
                ->progressBar()
                ->flash();
            }

            ComboProducto::where('combo_id', $this->producto->id)->delete();

            toastr()->title('Información')
                ->success('Producto actualizado')
                ->timeOut(3000)
                ->progressBar()
                ->flash();
                
            return redirect()->route('panel.administracion.productos.index');
        } else {

            $this->producto->codigo = $this->codigo;
            $this->producto->nombre = $this->nombre;
            $this->producto->detalle = $this->detalle;
            $this->producto->preciocosto = $this->preciocosto;
            $this->producto->preciolista = $this->preciolista;
            $this->producto->preciohappyhour = $this->preciohappyhour;
            $this->producto->combo = $this->combo;
            $this->producto->stock = $this->stock;
            $this->producto->updated_at = now();

            $this->producto->update();
            $this->producto->categorias()->sync($this->catSeleccionadas);

            ComboProducto::where('combo_id', $this->producto->id)->delete();


            foreach ($this->comboProducts as $key => $product) {
    
                $results = array(
                    'combo_id' => $this->producto->id,
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
