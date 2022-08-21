@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
        <a href="{{ route('panel.administracion.ventas.index') }}" class="btn btn-secondary float-right">Volver</a>

      

    <h1>Ingreso de compra</h1>
@stop

@section('content')
    @livewire('panel.administracion.productos.productos-create')
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
