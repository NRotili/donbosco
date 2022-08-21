@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
        @can('panel.administracion.clientes.create')
        <a href="{{ route('panel.administracion.clientes.create') }}" class="btn btn-secondary float-right">Agregar
            Cliente</a>

        @endcan
      

    <h1>Listado de Clientes</h1>
@stop

@section('content')
    @livewire('panel.administracion.clientes.clients-index')
@stop

@section('css')

@stop

@section('js')

    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirma la acción?',
                text: "El cliente quedará anulado",
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
                text: "El cliente quedará dado de alta!",
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
