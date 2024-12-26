<div>
    <div class="form-group">
        {!! Form::label('name', 'Nombre: ') !!}
        {!! Form::text('name', $railroadswitch?$railroadswitch->name:$name, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}
        @error('name')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('type_switch', 'Tipo de cambio: ') !!}
        {!! Form::text('type_switch', $railroadswitch?$railroadswitch->type_switch:$type_switch, ['class' => 'form-control'.($errors->has('type_switch') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}
        @error('type_switch')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <strong>Empresa</strong>
        @error('companies_id')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        {!! Form::select('companies_id',[""=>'Seleccione una opción'] + $companies, $selectedCompany, ['class' => 'form-control','wire:model' => 'selectedCompany']) !!}
    </div>
    <div class="form-group">
        <strong>Patio</strong>
        @error('yard_id')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        {!! Form::select('yard_id', ["" => 'Seleccione una opción'] + $yards, $selectedYard, ['class' => 'form-control', 'wire:model' => 'selectedYard']) !!}
    </div>
</div>
