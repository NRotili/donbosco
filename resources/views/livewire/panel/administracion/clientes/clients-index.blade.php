<div>
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="form-group col-md-4">

                    <label for="qr">Filtrar por QR</label>
                    <input id="qr" wire:model.lazy="qr" type="text" class="form-control" placeholder="Buscar por QR">

                </div>
                <div class="form-group col-md-3">

                    <label for="apellido">Filtrar por Apellido</label>
                    <input id="apellido" wire:model="apellido" type="text" class="form-control"
                        placeholder="Buscar por apellido">

                </div>
                <div class="form-group col-md-3">

                    <label for="nombre">Filtrar por Nombre</label>
                    <input id="nombre" wire:model="nombre" type="text" class="form-control"
                        placeholder="Buscar por nombre">

                </div>

                <div class="form-group col-md-2">
                    <label for="telefono">Filtrar por Celular</label>
                    <input id="telefono" wire:model="telcelular" placeholder="Buscar por celular" class="form-control">
                </div>


            </div>


        </div>

        @if ($clientes->count())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Apellido y Nombre</th>
                                <th>Tel. Cel.</th>
                                <th>Email</th>
                                <th class="text-center"colspan="4">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr class="disabled"
                                    @if ($cliente->habilitado == 0) style="text-decoration:line-through" @endif>
                                    <td>
                                        @if ($cliente->dni)
                                            {{ $cliente->dni }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ Str::upper($cliente->apellido) . ', ' . $cliente->nombre }}</td>
                                    <td>{{ $cliente->telcelular }}</td>
                                    <td>
                                        @if ($cliente->email)
                                            {{ $cliente->email }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td width="10px">
                                        @can('panel.administracion.clientes.show')
                                        <a href="{{ route('panel.administracion.clientes.show', $cliente) }}"
                                        class="btn btn-info btn-xs"><i class="mx-1 fas fa-info"></i></a>
                                        @endcan
                                    </td>

                                    <td width="10px">
                                        @can('panel.administracion.clientes.plus')
                                        <a class="btn btn-secondary btn-xs @if ($cliente->habilitado == 0) disabled @endif"
                                            href="{{ route('panel.administracion.clientes.plus', $cliente) }}"><i
                                                class="fas fa-plus"></i></a>
                                        @endcan
                                    </td>

                                    <td width="10px">
                                        @can('panel.administracion.clientes.edit')
                                        <a class="btn btn-warning btn-xs @if ($cliente->habilitado == 0) disabled @endif"
                                            href="{{ route('panel.administracion.clientes.edit', $cliente) }}"><i
                                                class="fas fa-pen"></i>
                                        </a>

                                        @endcan
                                    </td>

                                    <td width="10px">
                                        @can('panel.administracion.clientes.destroy')
                                        <form class="@if ($cliente->habilitado == 0) form-up @else form-delete @endif"
                                            action="{{ route('panel.administracion.clientes.destroy', $cliente->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')

                                            <button
                                                class="btn btn-xs @if ($cliente->habilitado == 0) btn-success @else btn-danger @endif"
                                                type="submit"><i
                                                    class="fas @if ($cliente->habilitado == 0) fa-arrow-up @else fa-arrow-down @endif"></i></button>
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
                {{ $clientes->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros.</strong>
            </div>
        @endif

    </div>

</div>
