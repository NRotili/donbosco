@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
          
            {!! Form::model($user, ['route'=>['panel.configuracion.users.update', $user], 'method'=>'put']) !!}

           @include('panel.configuracion.users.partials.form')

            {!! Form::submit('Editar usuario', ['class'=>'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
