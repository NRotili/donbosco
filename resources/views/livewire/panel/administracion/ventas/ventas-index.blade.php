<div>
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
    
                        <label for="date">Filtrar por Fecha</label>
                        <input id="date" wire:model="date" type="date" class="form-control">
    
                    </div>
                    <div class="form-group col-md-3">
    
                        <label for="apellido">Filtrar por Apellido</label>
                        <input id="apellido" wire:model="apellido" type="text" class="form-control"
                            placeholder="Buscar por apellido">
                            {{$apellido}}
    
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
    
            @if ($ventas->count())
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cant. Prod.</th>
                                    <th>Monto</th>
                                    <th>Cliente</th>
                                    <th class="text-center"colspan="3">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr class="disabled"
                                        @if ($venta->status == 0) style="text-decoration:line-through" @endif>
                                        <td>
                                            {{\Carbon\Carbon::parse($venta->created_at)->format('d/m/Y')}}
                                        </td>
                                    
                                        <td>{{$venta->productos()->sum('cantidad')}}</td>
                                        <td>{{ $venta->total}}</td>
                                        <td>{{ Str::upper($venta->cliente->apellido) }}, {{ $venta->cliente->nombre }}</td>
 
                                        <td width="10px">
                                            @can('panel.administracion.ventas.show')
                                            <a href="{{ route('panel.administracion.ventas.show', $venta) }}"
                                                class="btn btn-info btn-xs"><i class="mx-1 fas fa-info"></i></a>
                                            @endcan
                                        </td>
    
                                      
    
                                        <td width="10px">
                                            @can('panel.administracion.ventas.show')
                                            <form class="@if ($venta->status == 0) form-up @else form-delete @endif"
                                                action="{{ route('panel.administracion.ventas.destroy', $venta) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
    
                                                <button
                                                    class="btn btn-xs @if ($venta->status == 0) btn-success @else btn-danger @endif"
                                                    type="submit"><i
                                                        class="fas @if ($venta->status == 0) fa-arrow-up @else fa-arrow-down @endif"></i></button>
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
                    {{ $ventas->links() }}
                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros.</strong>
                </div>
            @endif
    
        </div>
    
    </div>
    
</div>
