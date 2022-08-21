@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
        <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">Volver</a>

    <h1>Editar producto</h1>
@stop

@section('content')

    @livewire('panel.administracion.productos.productos-edit', ['producto' => $producto])
@stop

@section('js')

@stop
