<div>
    <div class="form-group">
        {!! Form::label('name', 'Nombre: ') !!}
        {!! Form::text('name', $railroadswitch?$railroadswitch->name:null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}
        @error('name')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('type_switch', 'Tipo de cambio: ') !!}
        {!! Form::text('type_switch', $railroadswitch?$railroadswitch->type_switch:null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}
        @error('name')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <strong>Empresa</strong>
        @error('companies')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        {!! Form::select('companies_id',[0=>'Seleccione una opción'] + $companies, $selectedCompany, ['class' => 'form-control','wire:model' => 'selectedCompany']) !!}
    </div>
    <div class="form-group">
        <strong>Patio</strong>
        @error('yards')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        {!! Form::select('yard_id', [0 => 'Seleccione una opción'] + $yards, $selectedYard, ['class' => 'form-control', 'wire:model' => 'selectedYard']) !!}
    </div>
</div>
