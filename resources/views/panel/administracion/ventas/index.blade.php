@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
        @can('panel.administracion.ventas.create')
        <a href="{{ route('panel.administracion.ventas.create') }}" class="btn btn-secondary float-right">Nueva venta</a>
        @endcan
      

    <h1>Listado de ventas</h1>
@stop

@section('content')
    @livewire('panel.administracion.ventas.ventas-index')
@stop

@section('js')

    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirma la acción?',
                text: "La venta quedará anulada",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí, anular!'
            }).then((result) => {
                if (result.value) {
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                    //Send form
                    this.submit();
                }
            })

        })

        $('.form-up').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Estás seguro de restablecer?',
                text: "La venta quedará dada de alta!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí, restablecer!'
            }).then((result) => {
                if (result.value) {
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                    //Send form
                    this.submit();
                }
            })

        })
    </script>

@stop
