<div class="form-group">
    {!! Form::label('name', 'Nombre: ') !!}
    {!! Form::text('name', null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}

    @error('name')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('description', 'Descripción: ') !!}
    {!! Form::text('description', null, ['class' => 'form-control'.($errors->has('description') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}

    @error('description')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror
</div>
