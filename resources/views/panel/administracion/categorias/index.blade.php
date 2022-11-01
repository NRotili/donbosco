@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    @can('panel.administracion.categorias.create')
        <a href="{{ route('panel.administracion.categorias.create') }}" class="btn btn-secondary float-right">Nueva categoría</a>
    @endcan
    <h1>Lista de categorías</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categoría</th>
                        <th colspan="3">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <th @if ($categoria->status == 0) style="text-decoration:line-through" @endif>
                                {{ $categoria->id }}</th>
                            <td @if ($categoria->status == 0) style="text-decoration:line-through" @endif>
                                {{ $categoria->nombre }}</td>
                            <td width="10px">
                                @can('panel.administracion.categorias.show')
                                    <a href="{{ route('panel.administracion.categorias.show', $categoria) }}"
                                        class="btn btn-info btn-xs"><i class="mx-1 fas fa-info"></i></a>
                                @endcan
                            </td>
                            <td width="10px">
                                @if ($categoria->status)
                                    @can('panel.administracion.categorias.edit')
                                        <a href="{{ route('panel.administracion.categorias.edit', $categoria) }}"
                                            class="btn btn-xs btn-warning"><i class="fas fa-pen"></i></a>
                                    @endcan
                                @endif

                            </td>
                            <td width="10px">
                                @can('panel.administracion.categorias.destroy')
                                    <form action="{{ route('panel.administracion.categorias.destroy', $categoria) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button
                                            class="btn btn-xs @if ($categoria->status == 0) btn-success @else btn-danger @endif"
                                            type="submit"><i
                                                class="fas @if ($categoria->status == 0) fa-arrow-up @else fa-arrow-down @endif"></i></button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
