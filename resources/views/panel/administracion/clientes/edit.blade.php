@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($cliente, ['route' => ['panel.administracion.clientes.update', $cliente], 'method' => 'put']) !!}

            @include('panel.administracion.clientes.partials.form')

            {!! Form::submit('Actualizar cliente', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
