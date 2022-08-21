@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Crear nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'panel.configuracion.roles.store']) !!}
                @include('panel.configuracion.roles.partials.form')
                {!! Form::submit('Crear rol', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
