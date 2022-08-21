@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Agregar usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'panel.configuracion.users.store']) !!}

                @include('panel.configuracion.users.partials.form')

                {!! Form::submit('Crear usuario', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
