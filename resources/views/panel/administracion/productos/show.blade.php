@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')

    <a href="{{ url()->previous() }}" class="btn btn-secondary float-right ml-2">VOLVER</a>
    <a href="{{ route('panel.administracion.productos.edit', $producto->id) }}" class="btn btn-warning float-right"><i class="fas fa-pen"></i></a>


    <h1><u>Producto:</u> <strong>{{ Str::upper($producto->nombre) }} - ({{ $producto->codigo }})</strong></h1>
@stop

@section('content')
    <div class="row">
        <div class="col col-12 col-md-6">
            <x-adminlte-info-box title="Detalle del producto" text="{{ $producto->detalle }}" icon="fas fa-lg fa-info" />
        </div>
        <div class="col col-12 col-md-3">
            @if ($producto->combo)
                <x-adminlte-info-box title="Stock" text="Es combo" icon="fas fa-lg fa-boxes" />
            @else
                <x-adminlte-info-box title="Stock" text="{{ $producto->stock }}" icon="fas fa-lg fa-boxes" />
            @endif
        </div>
        <div class="col col-12 col-md-3">
            @if ($producto->status)
                <x-adminlte-info-box title="Status" text="Publicado" icon="far fa-lg fa-calendar" />
            @else
                <x-adminlte-info-box title="Status" text="Deshabilitado" icon="far fa-lg fa-calendar" />
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-3">
            <x-adminlte-info-box title="Precio Costo" text="{{ $producto->preciocosto }}" icon="fas fa-lg fa-dollar-sign" />

        </div>

        <div class="col col-12 col-md-3">
            <x-adminlte-info-box title="Precio Lista" text="{{ $producto->preciolista }}" icon="fas fa-lg fa-dollar-sign" />
        </div>

        <div class="col col-12 col-md-3">
            <x-adminlte-info-box title="Precio Happy Hour" text="{{ $producto->preciohappyhour }}"
                icon="fas fa-lg fa-dollar-sign" />
        </div>
        <div class="col col-12 col-md-3">
            @if ($producto->combo)
                <x-adminlte-info-box title="Capital en stock" text="NO CALCULA" icon="fas fa-lg fa-dollar-sign" />
            @else
                <x-adminlte-info-box title="Capital en stock" text="{{ $producto->preciocosto * $producto->stock }}"
                    icon="fas fa-lg fa-dollar-sign" />
            @endif

        </div>

    </div>


    <div class="row">
        <div class="col col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Últimas 5 ventas
                </div>
                <div class="card-body">
                    @if($producto->ventas->count() > 0)
                    <table class="table table-striped">
                        
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Cliente</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($producto->ventas->sortByDesc('id')->take(5) as $venta)
                                <tr>
                                    <th scope="row"><a
                                            href="{{ route('panel.administracion.ventas.show', $venta->id) }}">{{ $venta->id }}</a>
                                    </th>
                                    <td>{{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y - H:i') }}</td>
                                    <td>{{ $venta->pivot->cantidad }}</td>
                                    <td><a href="{{ route('panel.administracion.clientes.show', $venta->cliente->id) }}">{{ $venta->cliente->apellido }},
                                            {{ $venta->cliente->nombre }}</a></td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @else
                    <strong>No hay datos para mostrar</strong>
                    @endif
                </div>
            </div>
        </div>

        <div class="col col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    @if ($producto->combo)
                        Contiene los siguientes productos
                    @else
                        Se encuentra en los siguientes combos
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                           

                        </thead>
                        <tbody>

                            @if ($producto->combo)
                                @foreach ($producto->contproductos as $contiene)
                                    <tr>
                                        <th scope="row"><a
                                                href="{{ route('panel.administracion.productos.show', $contiene->id) }}">{{ $contiene->id }}</a>
                                        </th>
                                        <td>{{ $contiene->nombre }}</td>
                                        <td>{{ $contiene->pivot->cantidad }}</td>
                                      
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($producto->combos as $combo)
                                    <tr>
                                        <th scope="row"><a
                                                href="{{ route('panel.administracion.productos.show', $combo->id) }}">{{ $combo->id }}</a>
                                        </th>
                                        <td>{{ $combo->nombre }}</td>
                                        <td>{{ $combo->pivot->cantidad }}</td>
                                      
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
