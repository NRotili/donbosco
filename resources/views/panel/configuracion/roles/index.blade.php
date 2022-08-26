@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
        @can('panel.configuracion.roles.create')
        <a href="{{route('panel.configuracion.roles.create')}}" class="btn btn-secondary float-right">Nuevo rol</a>
        @endcan
    <h1>Lista de roles</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td width="10px">
                                @can('panel.configuracion.roles.edit')
                                    <a href="{{route('panel.configuracion.roles.edit', $role)}}" class="btn btn-xs btn-warning"><i class="fas fa-pen"></i></a>
                                    @endcan
                            </td>
                            <td width="10px">
                                @can('panel.configuracion.roles.destroy')
                                    <form action="{{route('panel.configuracion.roles.destroy', $role)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
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
