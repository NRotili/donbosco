<div>

    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="form-group col-md-4">

                    <label for="codigo">Filtrar por Código</label>
                    <input id="codigo" wire:model="codigo" type="text" class="form-control"
                        placeholder="Buscar por código">

                </div>
                <div class="form-group col-md-4">

                    <label for="nombre">Filtrar por Nombre</label>
                    <input id="nombre" wire:model="nombre" type="text" class="form-control"
                        placeholder="Buscar por nombre">

                </div>
                <div class="form-group col-md-4">

                    <label for="detalle">Filtrar por Detalle</label>
                    <input id="detalle" wire:model="detalle" type="text" class="form-control"
                        placeholder="Buscar por detalle">

                </div>



            </div>


        </div>

        @if ($productos->count())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>$ Costo</th>
                                <th>$ Lista</th>
                                <th>$ HH</th>
                                <th>$ Mayorista</th>
                                <th>Stock</th>
                                <th class="text-center"colspan="4">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr class="disabled"
                                    @if ($producto->status == 0) style="text-decoration:line-through" @endif>
                                    <td>{{ $producto->nombre }}</td>
                                    
                                    <td>${{ $producto->preciocosto }}</td>
                                    <td>${{ $producto->preciolista }}</td>
                                    <td>${{ $producto->preciohappyhour }}</td>
                                    <td>${{ $producto->preciomayorista }}</td>
                                    <td>
                                        @if (!$producto->combo)
                                            {{ $producto->stock }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td width="10px">
                                        @can('panel.administracion.productos.show')
                                            <a href="{{ route('panel.administracion.productos.show', $producto) }}"
                                                class="btn btn-info btn-xs"><i class="mx-1 fas fa-info"></i></a>
                                        @endcan
                                    </td>


                                    <td width="10px">
                                        @if (!$producto->combo && $producto->status == 1)
                                            @can('panel.administracion.productos.edit')
                                                <button wire:click="editStock({{ $producto->id }})" data-toggle="modal"
                                                    data-target="#modalMin"
                                                    class="btn btn-secondary btn-xs @if ($producto->status == 0) disabled @endif"><i
                                                        class="fas fa-box-open"></i>
                                                </button>
                                            @endcan
                                        @endif
                                        

                                    </td>

                                    <td width="10px">
                                        @if ($producto->status == 1)
                                            @can('panel.administracion.productos.edit')
                                                <a class="btn btn-warning btn-xs "
                                                    href="{{ route('panel.administracion.productos.edit', $producto) }}"><i
                                                        class="fas fa-pen"></i>
                                                </a>
                                            @endcan
                                        @endif


                                    </td>


                                    <td width="10px">
                                        @can('panel.administracion.productos.destroy')
                                            <form class="@if ($producto->status == 0) form-up @else form-delete @endif"
                                                action="{{ route('panel.administracion.productos.destroy', $producto->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')

                                                <button
                                                    class="btn btn-xs @if ($producto->status == 0) btn-success @else btn-danger @endif"
                                                    type="submit"><i
                                                        class="fas @if ($producto->status == 0) fa-arrow-up @else fa-arrow-down @endif"></i></button>
                                            </form>
                                        @endcan

                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {{ $productos->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros.</strong>
            </div>
        @endif

    </div>

    {{-- Minimal --}}
    <x-adminlte-modal wire:ignore.self id="modalMin"
        title="Stock del producto: {{ $titleModal }} ({{ $stockModal }})" static-backdrop>
        <div>
            <div class="form-group">
                <label for="stock">Incrementar o decrementar stock</label>
                <input class="form-control" wire:model.defer="stock" type="number" name="stock" id="stock">
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Actualizar"
                wire:click.prevent="updateStock({{ $idModal }})" data-dismiss="modal" />
            <x-adminlte-button theme="secondary" label="Cancelar" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>



</div>
