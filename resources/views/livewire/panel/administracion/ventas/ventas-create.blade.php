<div>
    @if ($selected_id > 0)
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="mb-4">
                                    <strong>Nombre del cliente:
                                        {{ $cliente->apellido . ', ' . $cliente->nombre }}</strong>
                                </h5>
                                <button type="button" wire:click="doAction(0)"
                                    class="btn btn-outline-secondary btn-rounded btn-icon float-right"><i
                                        class="fas fa-trash text-danger"></i></button>
                                <p class="ml-5">DNI: <strong>{{ $cliente->dni }}</strong></p>
                                <p class="ml-5">Tel. Cel.: <strong>{{ $cliente->telcelular }}</strong></p>
                                <p class="ml-5">Fecha Nacimiento: <strong>{{ $cliente->fechanacimiento }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body mb-3">
                                <div class="card-body">
                                    Puntos por esta venta: {{$puntos}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col col-12 grid-margin">
                <div class="card">
                    <div class="row">
                        <div class="col col-12 col-md-6">
                            <div class="card-body">
                                <label for="">Seleccione un cliente:</label>
                                <select wire:model.lazy="selected_id" name="" id=""
                                    class="form-control form-control-sm">
                                    <option value="">Seleccione cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">
                                            {{ $cliente->apellido . ', ' . $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('selected_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col col-12 col-md-6">
                            <div class="card">
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-md-5">
                    <div class="form-group">
                        <label for=""><strong>Buscar producto</strong></label>
                        <select class="form-control form-control-sm" name="" id=""
                            wire:model="product_id">
                            <option value="">Seleccione producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }} ({{$producto->stock}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-1">
                    <div class="form-group">
                        <label for=""><strong>Cantidad:</strong></label>
                        <input type="number" class="form-control form-control-sm" name="" id=""
                            wire:model.defer="cantidad">
                    </div>
                </div>
                <div class="col col-md-2">
                    <div class="form-group">
                        <label for=""><strong>Precio Lista:</strong></label>
                        <input type="number" class="form-control form-control-sm" value="" name=""
                            id="" wire:model.defer="preciolista" @if($isDisabledLista) disabled @endif>
                    </div>
                </div>
                <div class="col col-md-2">
                    <div class="form-group">
                        <label for=""><strong>Precio Happy Hour:</strong></label>
                        <input type="number" class="form-control form-control-sm" name="" id=""
                            wire:model.defer="preciohappyhour" @if($isDisabledHH) disabled @endif >
                    </div>
                </div>
                <div class="col col-md-1">
                <div class="form-group">
                    <label for=""><strong>HH?</strong></label>
                    <input type="checkbox" class="form-control form-control-sm" name="" id=""
                        wire:model="checkHH">
                </div>
                </div>
                <div class="col col-md-1">
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm mt-4 ml-2"
                            wire:click.prevent="addProduct()">Agregar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>


        


        <div class="row">
            <div class="col col-12">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid mt-1 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th>#</th>
                                            <th>Descripción</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Precio lista</th>
                                            <th class="text-center">Precio HH</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderProducts as $key => $product)
                                            <tr class="text-center" wire:key="{{ $key }}">
                                                <td class="text-center"> {{ $key + 1 }}</td>
                                                <td class="text-left"> {{ $product['name'] }}</td>
                                                <td class="text-center"> {{ $product['cantidad'] }}</td>
                                                <td class="text-center"> {{ $product['preciolista'] }}</td>
                                                <td class="text-center"> {{ $product['preciohappyhour'] }}</td>
                                                <td class="text-center"> {{ $product['itemtotal'] }}</td>
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
                        <div class="container-fluid mt-5 w-100">
                            <p class="text-right mb-2">Subtotal: ${{ $subtotal }}</p>
                            <p class="text-right mb-2">IVA: $0</p>
                            <h4 class="text-right mb-2">Total: ${{ $total }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="mb-5 mt-1 ">
        <button type="submit" class="btn btn-block btn-success" wire:click.prevent="storeOrder()">Guardar</button>
    </div>


</div>
