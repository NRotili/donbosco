@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    {{-- @can('panel.roles.create') --}}
        <a href="{{route('panel.configuracion.users.create')}}" class="btn btn-secondary float-right">Nuevo usuario</a>
    {{-- @endcan --}}
    <h1>Lista de usuarios</h1>
@stop

@section('content')
<div>
    @if (session('info'))
        <div class="alert alert-success" >
            {{ session('info') }}
        </div>
    @endif
    <div class="card">

        @if ($users->count())
           <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td width="10px">
                                    <a class="btn btn-warning btn-xs" href="{{ route('panel.configuracion.users.edit', $user) }}"><i
                                        class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros.</strong>
            </div>
        @endif
        
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
