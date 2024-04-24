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
    <strong>Ubicaciones</strong>
    @error('locations')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
    @enderror

    {!! Form::select('location_id', $locations, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <strong>Empresa</strong>
    @error('locations')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
    @enderror   
    {!! Form::select('company_id', $companies, null, ['class' => 'form-control mt-2']) !!}
</div>