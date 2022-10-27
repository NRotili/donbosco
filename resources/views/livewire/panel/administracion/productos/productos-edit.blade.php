<div>
    <div>

        <div class="card">
            <div class="card-body">
    
    
                <div class="form-row">
    
                    <div class="form-group col-md-3">
                        <label for="codigo">Código</label>
                        <input type="text" class="form-control" name="codigo" id="codigo"
                            placeholder="Código del producto" wire:model.defer="codigo">
                    </div>
    
                    <div class="form-group col-md-3">
                        <label for="nombre">Nombre*</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"
                            placeholder="Nombre del producto" wire:model.defer="nombre" required>
                            @if($errors->has('nombre'))
                            <small class="text-danger">{{$errors->first('nombre')}}</small>
                    @endif
                    </div>
    
                    <div class="form-group col-md-6">
                        <label for="detalle">Detalle</label>
                        <input type="text" class="form-control" name="detalle" id="detalle"
                            placeholder="Detalle del producto" wire:model.defer="detalle">
                    </div>
    
                </div>
    
                <div class="form-row">
    
                    <div class="form-group col-12 col-md-1">
                        <label for="combo"><strong>Combo?</strong></label>
                        <input type="checkbox" class="form-control form-control-sm" name="combo" id="combo"
                            wire:model="combo">
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock"
                            @if ($combo) disabled @endif wire:model.defer="stock">
                            @if($errors->has('stock'))
                        <small class="text-danger">{{$errors->first('stock')}}</small>
                    @endif
                    </div>
    
                    <div class="form-group col-md-3">
                        <label for="preciocosto">Precio Costo*</label>
                        <input type="number" class="form-control" name="preciocosto" id="preciocosto"
                            placeholder="Utilice . para decimal" wire:model.defer="preciocosto" required>
                            @if($errors->has('precioCosto'))
                        <small class="text-danger">{{$errors->first('precioCosto')}}</small>
                    @endif
    
                    </div>
    
                    <div class="form-group col-md-3">
                        <label for="preciolista">Precio Lista*</label>
                        <input type="number" class="form-control" name="preciolista" id="preciolista"
                            placeholder="Utilice . para decimal" wire:model.defer="preciolista" required>

                            @if($errors->has('precioLista'))
                        <small class="text-danger">{{$errors->first('precioLista')}}</small>
                    @endif
    
                    </div>
                    <div class="form-group col-md-3">
                        <label for="preciohappyhour">Precio HH*</label>
                        <input type="number" class="form-control" name="preciohappyhour" id="preciohappyhour"
                            placeholder="Utilice . para decimal" wire:model.defer="preciohappyhour" required>

                            @if($errors->has('precioHappyHour'))
                        <small class="text-danger">{{$errors->first('precioHappyHour')}}</small>
                    @endif
    
                    </div>
    
                </div>
    
    
            </div>
        </div>
    

        <div class="row">
            <div class="col col-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Categorías</strong>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
    
                            @foreach ($categorias as $categoria)
                                <div class="col col-6 col-md-2">
                                    <label>
                                        <input type="checkbox" value="{{ $categoria->id }}"
                                            wire:model="catSeleccionadas" class="form-checkbox"
                                          >
                                        <span class="ml-1">{{ $categoria->nombre }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    
        </div>


        @if ($combo)
            <div class="row">
                <div class="col col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-7">
                                    <div class="form-group">
                                        <label for=""><strong>Buscar producto</strong></label>
                                        <select class="form-control form-control-sm" name="" id=""
                                            wire:model="product_id">
                                            <option value="">Seleccione producto</option>
                                            @foreach ($productos as $productocbo)
                                                <option value="{{ $productocbo->id }}">{{ $productocbo->nombre }}
                                                    ({{ $productocbo->detalle }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-md-3">
                                    <div class="form-group">
                                        <label for=""><strong>Cantidad:</strong></label>
                                        <input type="number" class="form-control form-control-sm" name=""
                                            id="" wire:model.defer="cantidad">
                                    </div>
                                </div>
    
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm mt-4 ml-2"
                                            wire:click.prevent="addProduct()">Agregar</button>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col col-12 col-md-6">
                    <div class="card px-2">
                        <div class="card-body">
                            <div class="container-fluid mt-1 d-flex justify-content-center w-100">
                                <div class="table-responsive w-100">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comboProducts as $key => $product)
                                                <tr class="text-center" wire:key="{{ $key }}">
                                                    <td class="text-center"> {{ $key + 1 }}</td>
                                                    <td class="text-left"> {{ $product['name'] }}</td>
                                                    <td class="text-center"> {{ $product['cantidad'] }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-danger btn-sm"
                                                            wire:click="removeItem({{ $key }})">X</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="mb-5 mt-1 ">
            <button type="submit" wire:loading.attr="disabled" class="btn btn-block btn-success" wire:click.prevent="updateProduct()">Actualizar</button>
        </div>
    
    
    </div>
    
</div>
