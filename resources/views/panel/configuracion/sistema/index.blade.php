@extends('adminlte::page')

@section('title', 'Sistema')

@section('content_header')

    <a href="{{ route('panel.configuraciones.sistema.edit', $config) }}" class="btn btn-secondary float-right">Editar
        información</a>


    <h1>Datos del sistema</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-12 col-md-4">
                    <x-adminlte-card title="Porcentaje para puntos" theme="dark" icon="fas fa-lg fa-percentage">
                        @if ($config->porcentajePuntos)
                           {{ $config->porcentajePuntos }}
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>
                </div>
                <div class="col col-12 col-md-4">
                    <x-adminlte-card title="Alerta stock bajo" theme="dark" icon="fas fa-lg fa-arrow-down">
                        @if ($config->stockBajo)
                           {{ $config->stockBajo }}
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>
                </div>
                <div class="col col-12 col-md-4">
                    <x-adminlte-card title="Alerta stock alto" theme="dark" icon="fas fa-lg fa-arrow-up">
                        @if ($config->stockAlto)
                           {{ $config->stockAlto }}
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>
                </div>
                <div class="col col-12 col-md-6">
                    <x-adminlte-card title="Facebook" theme="dark" icon="fab fa-lg fa-facebook">
                        @if ($config->facebook)
                            <a href="{{ $config->facebook }}" target="_blank">{{ $config->facebook }}</a>
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>
                </div>

                <div class="col col-12 col-md-6">
                    <x-adminlte-card title="Instagram" theme="dark" icon="fab fa-lg fa-instagram">
                        @if ($config->instagram)
                            <a href="{{ $config->instagram }}" target="_blank">{{ $config->instagram }}</a>
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>
                </div>

                <div class="col col-12 col-md-6">
                    <x-adminlte-card title="Twitter" theme="dark" icon="fab fa-lg fa-twitter">
                        @if ($config->twitter)
                            <a href="{{ $config->twitter }}" target="_blank">{{ $config->twitter }}</a>
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>

                </div>

                <div class="col col-12 col-md-6">
                    <x-adminlte-card title="Tiktok" theme="dark" icon="fab fa-lg fa-tiktok">
                        @if ($config->tiktok)
                            <a href="{{ $config->tiktok }}" target="_blank">{{ $config->tiktok }}</a>
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>

                </div>

                <div class="col col-12 col-md-6">
                    <x-adminlte-card title="Whatsapp" theme="dark" icon="fab fa-lg fa-whatsapp">
                        @if ($config->whatsapp)
                            <a href="https://wa.me/{{ $config->whatsapp }}" target="_blank">{{ $config->whatsapp }}</a>
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>

                </div>

                <div class="col col-12 col-md-6">
                    <x-adminlte-card title="Email" theme="dark" icon="fas fa-lg fa-at">
                        @if ($config->email)
                            <a href="{{ $config->email }}" target="_blank">{{ $config->email }}</a>
                        @else
                            Sin configurar
                        @endif
                    </x-adminlte-card>

                </div>


            </div>
        </div>
    </div>

@stop
