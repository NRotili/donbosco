@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">

        <div class="col col-12 col-md-3">
            <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Cumpleaños de hoy">
                @if ($clientes->count() != 0)
                    @foreach ($clientes as $cliente)
                        <div class="row">
                            <div class="col col-12 mt-1">
                                {{ Str::upper($cliente->apellido) }}, {{ $cliente->nombre }}
                                ({{ \Carbon\Carbon::parse($cliente->fechanacimiento)->age }})
                                <a target="_blank" href="https://wa.me/+549{{ $cliente->telcelular }}"
                                    class="btn btn-xs btn-outline-info float-right"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    Sin cumpleaños
                @endif



            </x-adminlte-callout>
        </div>

        <div class="col col-12 col-md-3">
            <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Ventas del día">
                @if ($ventaHoy > 0)
                    <strong>$ {{ $ventaHoy }}</strong>
                @else
                    Sin ventas
                @endif

            </x-adminlte-callout>
        </div>
        <div class="col col-12 col-md-3">
            <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Ventas del mes">
                @if ($ventaMes > 0)
                    <strong>$ {{ $ventaMes }}</strong>
                @else
                    Sin ventas
                @endif

            </x-adminlte-callout>
        </div>
        <div class="col col-12 col-md-3">
            <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Ventas del año">
                @if ($ventaAnual > 0)
                    <strong>$ {{ $ventaAnual }}</strong>
                @else
                    Sin ventas
                @endif

            </x-adminlte-callout>
        </div>
    </div>
    {{-- Productos alto/bajo stock --}}
    <div class="row">
        <div class="col col-12 col-md-6">
            <x-adminlte-card title="Productos con stock bajo" theme="info" icon="fas fa-lg fa-arrow-down" collapsible="collapsed">
                @if ($productosBajoStock->count() > 0)

                    <table class="table table-striped">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                            </tr>

                        </thead>
                        <tbody>


                            @foreach ($productosBajoStock as $bajoStock)
                                <tr>
                                    <th scope="row"><a
                                            href="{{ route('panel.administracion.productos.show', $bajoStock->id) }}">{{ $bajoStock->id }}</a>
                                    </th>
                                    <td>{{ $bajoStock->nombre }}</td>
                                    <td>{{ $bajoStock->stock }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <strong>No hay productos para mostrar</strong>
                @endif
            </x-adminlte-card>
        </div>

        <div class="col col-12 col-md-6">
            <x-adminlte-card title="Productos con stock alto" theme="info" icon="fas fa-lg fa-arrow-up" collapsible="collapsed">
                @if ($productosAltoStock->count() > 0)

                    <table class="table table-striped">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                            </tr>

                        </thead>
                        <tbody>


                            @foreach ($productosAltoStock as $altoStock)
                                <tr>
                                    <th scope="row"><a
                                            href="{{ route('panel.administracion.productos.show', $altoStock->id) }}">{{ $altoStock->id }}</a>
                                    </th>
                                    <td>{{ $altoStock->nombre }}</td>
                                    <td>{{ $altoStock->stock }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <strong>No hay productos para mostrar</strong>
                @endif
            </x-adminlte-card>
        </div>
    </div>

    {{-- Top 5 productos --}}
    <div class="row">
        <div class="col col-12 col-md-6">
            <x-adminlte-card title="Top 5 más vendidos" theme="info" icon="fas fa-lg fa-shopping-cart" collapsible="collapsed">
                @if ($productosBajoStock->count() > 0)

                    <table class="table table-striped">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($topsales as $top)
                            <tr>
                                <th scope="row"><a
                                        href="{{ route('panel.administracion.productos.show', $top->id) }}">{{ $top->id }}</a>
                                </th>
                                <td>{{ $top->nombre }}</td>
                                <td>{{ $top->total }}</td>

                            </tr>
                        @endforeach

                       
                        </tbody>

                    </table>
                @else
                    <strong>No hay productos para mostrar</strong>
                @endif
            </x-adminlte-card>
            
        </div>

    </div>
@stop

@section('css')

@stop

@section('js')

@stop
