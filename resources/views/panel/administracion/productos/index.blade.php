@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
        @can('panel.administracion.productos.create')
        <a href="{{ route('panel.administracion.productos.create') }}" class="btn btn-secondary float-right">Agregar
            Producto</a>

        @endcan
      

    <h1>Listado de Productos</h1>
@stop

@section('content')
    @livewire('panel.administracion.productos.productos-index')
@stop

@section('css')

@stop

@section('js')

    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirma la acción?',
                text: "El producto quedará anulado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí, anular!'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            })

        })

        $('.form-up').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Estás seguro de restablecer?',
                text: "El producto quedará dado de alta!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí, restablecer!'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            })

        })
    </script>

@stop
