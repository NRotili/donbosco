@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
  
    <h1>Reportes de productos</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    <div class="row">
        <div class="col col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    Precio de lista y Happy Hour
                </div>
                <div class="card-body">
                    <a href="{{route('panel.reportes.productos.listahh')}}" class="btn btn-primary btn-block">GENERAR PDF</a>
                </div>
            </div>
        </div>
        <div class="col col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    Precio mayorista
                </div>
                <div class="card-body">
                    <a href="{{route('panel.reportes.productos.mayorista')}}" class="btn btn-primary btn-block">GENERAR PDF</a>
                </div>
            </div>
        </div>
    </div>
    
@stop
