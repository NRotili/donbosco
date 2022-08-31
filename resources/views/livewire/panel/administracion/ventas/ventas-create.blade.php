<div>
    <div class="row">
        <div class="col col-12 col-md-6">
            {{-- Selección de cliente --}}
            @if ($selected_id > 0)
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
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
                                        <p class="ml-5">Fecha Nacimiento:
                                            <strong>{{ $cliente->fechanacimiento }}</strong>
                                        </p>
                                        <p class="ml-5">Puntos por esta venta: <strong>{{ $puntos }}</strong>
                                        </p>
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
                                <div class="col col-12 col-md-12">
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
                                        @if($errors->has('cliente'))
                                            <small class="text-danger">{{$errors->first('cliente')}}</small>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col col-12 col-md-9">
                            <label for="metodopago">Seleccione método de pago:</label>
                            <select wire:model="mediopago_id" name="" id="metodopago"
                                class="form-control form-control-sm">
                                <option value="" hidden>Seleccione método</option>
                                @foreach ($mediosdepago as $mp)
                                    <option value="{{ $mp->id }}">
                                        {{ $mp->nombre }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('medio_de_pago'))
                            <small class="text-danger">{{$errors->first('medio_de_pago')}}</small>
                            @endif
                        </div>
                        <div class="col col-12 col-md-3">
                            <label for="porcentaje">Porcentaje:</label>
                            <input type="number" class="form-control form-control-sm" name="" id="porcentaje"
                            wire:model.lazy="recargo">
                            
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col col-12 col-md-12">
                            <label for="fecha">Seleccione fecha de venta:</label>
                            <div class="row">
                                <div class="col col-md-6">

                                    <input class="form-control" wire:model="fecha" type="date" value="" name="" id="">
                                </div>
                                <div class="col col-md-6">
                                    <input class="form-control" wire:model="hora" type="time" value="" name="" id="">
                                </div>

                            </div>
                            @if($errors->has('medio_de_pago'))
                            <small class="text-danger">{{$errors->first('medio_de_pago')}}</small>
                            @endif
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- Búsqueda de productos --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-md-5">
                    <div class="form-group" wire:ignore>
                        <label for=""><strong>Buscar producto</strong></label>
                        <select class="select2 form-control form-control-sm " name="" id=""
                            wire:model="product_id">
                            <option value="">Seleccione producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }} ({{ $producto->stock }})
                                    -
                                    {{ $producto->codigo }}</option>
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
                            id="" wire:model.defer="preciolista"
                            @if ($isDisabledLista) disabled @endif>
                    </div>
                </div>
                <div class="col col-md-2">
                    <div class="form-group">
                        <label for=""><strong>Precio Happy Hour:</strong></label>
                        <input type="number" class="form-control form-control-sm" name="" id=""
                            wire:model.defer="preciohappyhour" @if ($isDisabledHH) disabled @endif>
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
                        <button class="agregaProducto btn btn-primary btn-sm mt-4 ml-2"
                            wire:click.prevent="addProduct()">Agregar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Detalle de venta --}}
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
                    @if($errors->has('productos'))
                            <small class="text-danger">{{$errors->first('productos')}}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Botón guardar --}}
    <div class="mb-5 mt-1 ">
        <button type="submit" wire:loading.attr="disabled" class="btn btn-block btn-success" wire:click.prevent="storeOrder()">Guardar</button>
    </div>


</div>


<script>
    document.addEventListener('livewire:load', function() {
        $('.select2').select2();
        $('.select2').on('change', function() {
            @this.set('product_id', this.value);
        });
       
    })
</script>
