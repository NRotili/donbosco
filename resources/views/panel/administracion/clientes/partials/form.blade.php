<div class="form-row">

    <div class="form-group col-md-2">
        {!! Form::label('dni', 'DNI') !!}
        {!! Form::text('dni', null, ['class' => 'form-control', 'placeholder' => 'DNI sin puntos']) !!}

        @error('dni')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group col-md-5">
        {!! Form::label('nombre', 'Nombre*') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}

        @error('nombre')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group col-md-5">
        {!! Form::label('apellido', 'Apellido*') !!}
        {!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Apellido', 'required']) !!}

        @error('apellido')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

 
</div>

<div class="form-row">

    <div class="form-group col-md-2">
        {!! Form::label('fechanacimiento', 'Fecha de Nacimiento*') !!}
        {!! Form::date('fechanacimiento', null, ['class' => 'form-control', 'required']) !!}

        @error('fechanacimiento')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group col-md-2">
        {!! Form::label('telfijo', 'Teléfono (Fijo)') !!}
        {!! Form::text('telfijo', null, ['class' => 'form-control', 'placeholder' => 'Sin 0']) !!}

        @error('telfijo')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group col-md-2">
        {!! Form::label('telcelular', 'Teléfono (Celular)*') !!}
        {!! Form::text('telcelular', null, ['class' => 'form-control', 'placeholder' => 'Sin 0 ni 15', 'required']) !!}

        @error('telcelular')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}

        @error('email')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    
</div>

@livewire('panel.administracion.clientes.clients-create')