<div>
    <div class="form-row">

        <div class="form-group col-md-4">
            {!! Form::label('domicilio', 'Domicilio') !!}
            {!! Form::text('domicilio', null, ['class' => 'form-control', 'placeholder' => 'Domicilio']) !!}
            
            @error('domicilio')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('', 'Provincia') !!}
            {!! Form::select('', $provincias, null, ['class' => 'form-control', 'wire:model'=>'province', 'placeholder'=>'Selecciona una opción']) !!}
        </div>
    
        <div class="form-group col-md-4">
            {!! Form::label('ciudade_id', 'Ciudad') !!}
            {!! Form::select('ciudade_id', $ciudades, null, ['class' => 'form-control']) !!}
    
            @error('ciudade_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
    
        </div>
    </div>
</div>