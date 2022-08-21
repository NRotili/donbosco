@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

    <a href="{{ route('panel.administracion.clientes.index') }}" class="btn btn-secondary float-right">VOLVER</a>


    <h1><u>Incrementar puntos a:</u> <strong>{{ Str::upper($cliente->apellido) . ', ' . $cliente->nombre }}</strong></h1>
@stop

@section('content')

    <div class="row">
        <div class="col col-12 col-md-6">

            <x-adminlte-info-box title="Puntos actuales" text="{{ $cliente->puntos }}" icon="far fa-lg fa-star" />


        </div>

        <div class="col col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <strong>Puntos a incrementar</strong>

                    {{-- {!! Form::open(['route' => 'panel.administracion.clientes.plusupdate']) !!} --}}
                        {{-- @csrf --}}

            {!! Form::model($cliente, ['route' => ['panel.administracion.clientes.plusupdate', $cliente], 'method' => 'put']) !!}

                    <div class="form-row">
                        <div class="col col-8">
                            {!! Form::number('puntos', 0, ['class' => 'form-control', 'placeholder' => 'Puntos', 'required']) !!}

                        </div>
                        <div class="col col-4">

                            {!! Form::submit('Sumar puntos', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>

@stop
