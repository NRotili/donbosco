@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Editar categoría</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">

            {!! Form::model($categoria, ['route' => ['panel.administracion.categorias.update', $categoria], 'method'=>'put']) !!}
                
                @include('panel.administracion.categorias.partials.form')
                {!! Form::submit('Actualizar categoría', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

