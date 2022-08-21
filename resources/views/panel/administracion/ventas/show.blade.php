@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
        <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">Volver</a>

      
    <h1>Información de venta</h1>

    

@stop

@section('content')

<div class="row">
    <div class="col col-12 col-md-4">
        <x-adminlte-info-box title="Cliente"
            text="{{ Str::upper($venta->cliente->apellido) . ', ' . $venta->cliente->nombre }}" icon="far fa-lg fa-user" />
    </div>
    <div class="col col-12 col-md-4">
        <x-adminlte-info-box title="Fecha y hora"
        text="{{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y - H:i:s') }}"
        icon="far fa-lg fa-calendar" />
    </div>
    <div class="col col-12 col-md-4">
        <x-adminlte-info-box title="Monto total"
            text="{{ $venta->total }}"
            icon="fas fa-lg fa-dollar-sign" />
    </div>
</div>

<div class="row">
    <div class="col col-12 col-md-12">

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Costo (unidad)</th>
                            <th>Precio Vendido (unidad)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($venta->productos as $producto)
                            <tr>
                                <td>
                                    {{$producto->nombre}}
                                </td>
                                <td>{{$producto->pivot->cantidad}}</td>
                                <td>{{$producto->pivot->preciocosto}}</td>
                                <td>{{$producto->pivot->preciovendido}}</td>
        
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    
</div>

@stop




