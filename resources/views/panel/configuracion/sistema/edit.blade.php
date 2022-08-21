@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

    <a href="{{ route('panel.configuraciones.sistema.index') }}" class="btn btn-secondary float-right">Volver</a>


    <h1>Editar datos del sistema</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif

<div class="card">
<div class="card-body">
    {!! Form::model($sistema, ['route' => ['panel.configuraciones.sistema.update', $sistema], 'method' => 'put']) !!}

    <div class="form-row">

        <div class="form-group col-md-3">
            {!! Form::label('porcentajePuntos', 'Porcentaje para puntos') !!}
            {!! Form::number('porcentajePuntos', null, ['class' => 'form-control']) !!}
    
            @error('porcentajePuntos')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('whatsapp', 'Whatsapp') !!}
            {!! Form::text('whatsapp', null, ['class' => 'form-control', 'placeholder' => 'Sin 0 ni 15']) !!}
    
            @error('whatsapp')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    
        <div class="form-group col-md-3">
            {!! Form::label('facebook', 'URL del Perfil de Facebook') !!}
            {!! Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'https://...']) !!}
    
            @error('facebook')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    
        <div class="form-group col-md-3">
            {!! Form::label('instagram', 'URL del Perfil de Instagram') !!}
            {!! Form::text('instagram', null, ['class' => 'form-control', 'placeholder' => 'https://...']) !!}
    
            @error('instagram')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    
     
    </div>
    
    <div class="form-row">
    
        <div class="form-group col-md-4">
            {!! Form::label('twitter', 'URL del Perfil de Twitter') !!}
            {!! Form::text('twitter', null, ['class' => 'form-control', 'placeholder' => 'https://...']) !!}
    
            @error('twitter')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    
        <div class="form-group col-md-4">
            {!! Form::label('tiktok', 'URL del Perfil de Tiktok') !!}
            {!! Form::text('tiktok', null, ['class' => 'form-control', 'placeholder' => 'https://...']) !!}
    
            @error('tiktok')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    
        <div class="form-group col-md-4">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => '...@...']) !!}
    
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    
    </div>

    {!! Form::submit('Actualizar sistema', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
</div>

@stop
