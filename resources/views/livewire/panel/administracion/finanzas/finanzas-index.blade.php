<div>
    <div class="card">
        <div class="card-header">
            <strong class="text-dark">VENTAS</strong>
        </div>
        <div class="card-body">
            <div class="row">

                @can('panel.dashboard.ventasdia')
                    <div class="col col-12 col-md-6">
                        <x-adminlte-card title="DÍA" theme="info" theme-mode="outline" class="elevation-1">
                            <x-slot name="toolsSlot">
                                <div class="form-row">
                                    <input type="date" wire:model="dateGananciaHoy"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        class="w-auto form-control mr-1">
                                    <select wire:model="medioSelectedHoy" class="custom-select w-auto form-control">
                                        <option value="">Todos</option>
                                        @foreach ($mediosPagos as $medioPago)
                                            <option value="{{ $medioPago->id }}">{{ $medioPago->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </x-slot>

                            @if ($ventaHoy > 0)
                                <strong>$ {{ $ventaHoy }}</strong>
                            @else
                                Sin ventas
                            @endif

                        </x-adminlte-card>
                    </div>
                @endcan
                @can('panel.dashboard.ventasmes')
                    <div class="col col-12 col-md-6">
                        <x-adminlte-card title="MES" theme="info" theme-mode="outline" class="elevation-1">
                            <x-slot name="toolsSlot">
                                <div class="form-row">
                                    <input type="month" wire:model="dateGananciaMes" class="w-auto form-control mr-1">
                                    <select wire:model="medioSelectedMes" class="custom-select w-auto form-control ">
                                        <option value="">Todos</option>
                                        @foreach ($mediosPagos as $medioPago)
                                            <option value="{{ $medioPago->id }}">{{ $medioPago->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </x-slot>

                            @if ($ventaMes > 0)
                                <strong>$ {{ $ventaMes }}</strong>
                            @else
                                Sin ventas
                            @endif

                        </x-adminlte-card>
                    </div>
                @endcan
                @can('panel.dashboard.ventasaño')
                    <div class="col col-12 col-md-6">
                        <x-adminlte-card title="AÑO" theme="info" theme-mode="outline" class="elevation-1">
                            <x-slot name="toolsSlot">
                                <div class="form-row">
                                    <select wire:model="dateGananciaAño" class="custom-select w-auto form-control mr-1">
                                        @foreach ($años as $año)
                                            <option value="{{ $año }}">{{ $año }}</option>
                                        @endforeach
                                    </select>
                                    <select wire:model="medioSelectedAnual" class="custom-select w-auto form-control ">
                                        <option value="">Todos</option>
                                        @foreach ($mediosPagos as $medioPago)
                                            <option value="{{ $medioPago->id }}">{{ $medioPago->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </x-slot>

                            @if ($ventaAnual > 0)
                                <strong>$ {{ $ventaAnual }}</strong>
                            @else
                                Sin ventas
                            @endif

                        </x-adminlte-card>
                    </div>
                @endcan
                <div class="col col-12 col-md-6">
                    <x-adminlte-callout theme="info" title-class="text-info text-uppercase" title="Capital en stock">
                        <strong>$ {{ $capital }}</strong>
                    </x-adminlte-callout>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <strong class="text-dark">REMANENTES</strong>
        </div>
        <div class="card-body">
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
</div>
