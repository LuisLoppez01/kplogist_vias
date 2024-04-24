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
    {!! Form::label('type_component', 'Tipo de componente: ') !!}
    {!! Form::select('type_component', ['1'=>'Vía','2'=>'Herraje'] ,$route==='create'?null:$componentcatalog->type_component,['class' => 'form-control', 'placeholder' => 'Seleccione una opcion']) !!}
    @error('type_track')
    <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror
</div>
