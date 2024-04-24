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
    {!! Form::label('email', 'Correo: ') !!}
    {!! Form::text('email', null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba un correo']) !!}

    @error('name')
    <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror
</div>
@if($route === 'menu.users.create')
    <div class="form-group">
        {!! Form::label('password', 'Contraseña: ') !!}
        {!! Form::text('password', null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba una contraseña']) !!}

        @error('name')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
@endif

<div class="form-group">
    <strong>Empresa</strong>
    @error('companies')
    <small class="text-danger">
        <strong>{{$message}}</strong>
    </small>
    @enderror
    {!! Form::select('company_id', $companies, null, ['class' => 'form-control mt-2']) !!}
{{--    @dump($companies)--}}
</div>
<div class="form-group">
    @foreach ($roles as $role)
        <div>
            <label>
                {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1']) !!}
                {{$role->name}}
            </label>
        </div>
    @endforeach
</div>
