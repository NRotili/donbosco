@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
        <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">Volver</a>

      
    <h1>Información de categoría</h1>

@stop

@section('content')

<div class="row">
    <div class="col col-12 col-md-6">
        <x-adminlte-info-box title="Categoría"
            text="{{$categoria->nombre}}" icon="fas fa-lg fa-list" />
    </div>
    <div class="col col-12 col-md-6">
        <x-adminlte-info-box title="Cantidad de productos"
        text="{{$categoria->productos()->count()}}"
        icon="fas fa-lg fa-box-open" />
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
                            <th>ID Producto</th>
                            <th>Nombre</th>
                   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoria->productos as $producto)
                        <tr>
                            <th scope="row"><a
                                    href="{{ route('panel.administracion.productos.show', $producto->id) }}">{{ $producto->id }}</a>
                            </th>
                            <td>{{$producto->nombre}}</td>
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




