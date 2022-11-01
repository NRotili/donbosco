@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Crear nueva categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'panel.administracion.categorias.store']) !!}
                @include('panel.administracion.categorias.partials.form')
                {!! Form::submit('Crear categoría', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
