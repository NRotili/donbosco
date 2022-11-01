<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre de la categoría']) !!}

    @error('nombre')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>