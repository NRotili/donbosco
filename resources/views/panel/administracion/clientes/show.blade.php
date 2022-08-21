@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

    <a href="{{ route('panel.administracion.clientes.index') }}" class="btn btn-secondary float-right">VOLVER</a>


    <h1><u>Cliente:</u> <strong>{{ Str::upper($cliente->apellido) . ', ' . $cliente->nombre }}</strong></h1>
@stop

@section('content')
    <div class="row">
        <div class="col col-12 col-md-4">
            <x-adminlte-info-box title="Apellido y Nombre"
                text="{{ Str::upper($cliente->apellido) . ', ' . $cliente->nombre }}" icon="far fa-lg fa-user" />
        </div>
        <div class="col col-12 col-md-4">
            @if ($cliente->dni)
                <x-adminlte-info-box title="DNI" text="{{ $cliente->dni }}" icon="far fa-lg fa-address-card" />
            @else
                <x-adminlte-info-box title="DNI" text="SIN DATOS" icon="far fa-lg fa-address-card" />
            @endif
        </div>
        <div class="col col-12 col-md-4">
            <x-adminlte-info-box title="Fecha de Nacimiento"
                text="{{ \Carbon\Carbon::parse($cliente->fechanacimiento)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($cliente->fechanacimiento)->age }} años"
                icon="far fa-lg fa-calendar" />
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            {{-- Domicilio - Email - Tel. Fijo - Tel. Cel. --}}

            @if ($cliente->domicilio)
                <x-adminlte-info-box title="Domicilio"
                    text="{{ $cliente->domicilio . ', ' . $cliente->ciudade->nombre . ', ' . $cliente->ciudade->provincia->nombre }}"
                    icon="fas fa-lg fa-map-pin" />
            @else
                <x-adminlte-info-box title="Domicilio" text="SIN DATOS" icon="fas fa-lg fa-map-pin" />
            @endif


        </div>

        <div class="col col-12 col-md-6">
            @if ($cliente->email)
                <x-adminlte-info-box title="Email" text="{{ $cliente->email }}" icon="fas fa-lg fa-at" />
            @else
                <x-adminlte-info-box title="Email" text="SIN DATOS" icon="fas fa-lg fa-at" />
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col col-12 col-md-3">
            @if ($cliente->telfijo)
                <x-adminlte-info-box title="Teléfono (Fijo)" text="{{ $cliente->telfijo }}" icon="fas fa-lg fa-phone" />
            @else
                <x-adminlte-info-box title="Teléfono (Fijo)" text="SIN DATOS" icon="fas fa-lg fa-phone" />
            @endif
        </div>
        <div class="col col-12 col-md-3">
            <x-adminlte-info-box title="Teléfono (Cel)" text="{{ $cliente->telcelular }}" icon="fas fa-lg fa-mobile" />
        </div>
        <div class="col col-12 col-md-6">
            <x-adminlte-info-box title="Puntos" text="{{ $cliente->puntos }}" icon="far fa-lg fa-star" />

        </div>
    </div>

    <div class="row">
        <div class="col col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Últimas 5 compras
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cliente->ventas->sortByDesc('id')->take(5) as $venta)
                                <tr>
                                    <th scope="row"><a href="{{route('panel.administracion.ventas.show', $venta->id)}}">{{$venta->id}}</a></th>
                                    <td>{{\Carbon\Carbon::parse($venta->created_at)->format('d/m/Y - H:i')}}</td>
                                    <td>{{$venta->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="col col-12 col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl={{ env('APP_URL') }}/client/{{ $cliente->qr }}"
                        alt="QRcode">
                </div>
            </div>
        </div>
    </div>
@stop
