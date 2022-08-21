@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
   <div class="row">

    <div class="col col-12 col-md-4">
        <x-adminlte-callout theme="info" title-class="text-info text-uppercase"
    icon="fas fa-lg fa-birthday-cake" title="Cumpleaños de hoy">
    @if ($clientes->count() != 0)
        @foreach ($clientes as $cliente)
         <div class="row">
            <div class="col col-12 mt-1">
                {{Str::upper($cliente->apellido)}}, {{$cliente->nombre}}  ({{ \Carbon\Carbon::parse($cliente->fechanacimiento)->age }}) <a target="_blank" href="https://wa.me/+549{{$cliente->telcelular}}" class="btn btn-xs btn-outline-info float-right"><i class="fab fa-whatsapp"></i></a>
            </div>
         </div>
        @endforeach    
    @else
        Sin cumpleaños
    @endif
    
</x-adminlte-callout>
    </div>
   </div>
@stop

@section('css')

@stop

@section('js')
   
@stop
