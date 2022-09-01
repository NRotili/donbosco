@extends('adminlte::page')

@section('title', 'Finanzas')

@section('content_header')

    <h1>Finanzas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">

                @can('panel.dashboard.ventasdia')
                    <div class="col col-12 col-md-3">
                        <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Ventas del día">
                            @if ($ventaHoy > 0)
                                <strong>$ {{ $ventaHoy }}</strong>
                            @else
                                Sin ventas
                            @endif

                        </x-adminlte-callout>
                    </div>
                @endcan
                @can('panel.dashboard.ventasmes')
                    <div class="col col-12 col-md-3">
                        <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Ventas del mes">
                            @if ($ventaMes > 0)
                                <strong>$ {{ $ventaMes }}</strong>
                            @else
                                Sin ventas
                            @endif

                        </x-adminlte-callout>
                    </div>
                @endcan
                @can('panel.dashboard.ventasaño')
                    <div class="col col-12 col-md-3">
                        <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Ventas del año">
                            @if ($ventaAnual > 0)
                                <strong>$ {{ $ventaAnual }}</strong>
                            @else
                                Sin ventas
                            @endif

                        </x-adminlte-callout>
                    </div>
                @endcan
                <div class="col col-12 col-md-3">
                    <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Capital en stock">
                            <strong>$ {{ $capital }}</strong>
                    </x-adminlte-callout>
                </div>
            </div>
            <div class="row">
                <div class="col col-12 col-md-4">
                    <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Remanente del día">
                        @if ($remanenteHoy > 0)
                            <strong>$ {{ $remanenteHoy }}</strong>
                        @else
                            Sin ventas
                        @endif

                    </x-adminlte-callout>
                </div>
                <div class="col col-12 col-md-4">
                    <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Remanente del mes">
                        @if ($remanenteMes > 0)
                            <strong>$ {{ $remanenteMes }}</strong>
                        @else
                            Sin ventas
                        @endif

                    </x-adminlte-callout>
                </div>
                <div class="col col-12 col-md-4">
                    <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Remanente del año">
                        @if ($remanenteAnual > 0)
                            <strong>$ {{ $remanenteAnual }}</strong>
                        @else
                            Sin ventas
                        @endif

                    </x-adminlte-callout>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')


@stop
