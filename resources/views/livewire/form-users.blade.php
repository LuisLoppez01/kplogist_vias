<div>
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
        <strong>Empresa:</strong>
        @error('companies')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        {!! Form::select('company_id', [0 => 'Selecciona una opción'] + $companies, null, ['class' => 'form-control','wire:model' => 'selectedCompany']) !!}

        {{--        {!! Form::select('company_id', $companies, null, ['class' => 'form-control mt-2']) !!}--}}
    </div>
{{--    <div class="form-group">
        --}}{{-- <strong>Patios:</strong> --}}{{--
        @error('yards')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        @foreach($yards as $yard)
            <div>
                <label>
                    {!! Form::checkbox('yard_id[]', $yard->id, null, ['class'=>'mr-1']) !!}
                    <span>{{$yard->name}}</span>
                </label>
            </div>
        @endforeach
        --}}{{--        {!! Form::select('yards', [0 => 'Selecciona una opción'] +$yards, null, ['class' => 'form-control']) !!}--}}{{--
    </div>--}}
    <div class="form-group">
        <h4>Lista de Roles</h4>
        @foreach ($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1']) !!}
                    {{$role->name}}
                </label>
            </div>
        @endforeach
    </div>

</div>
