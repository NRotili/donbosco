@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Nuevo Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'panel.administracion.clientes.store']) !!}

                @include('panel.administracion.clientes.partials.form')

                {!! Form::button('Guardar datos ', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) !!}
                {{-- {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!} --}}
            {!! Form::close() !!}
        </div>
    </div>
@stop

