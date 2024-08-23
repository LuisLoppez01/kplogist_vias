<div>
    <div class="form-group">
        {!! Form::label('name', 'Nombre: ') !!}
        {!! Form::text('name', $tracksection?$tracksection->name:null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}
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
        @error('locations')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        {!! Form::select('yard_id', [0 => 'Seleccione una opción'] + $yards, $selectedYard, ['class' => 'form-control', 'wire:model' => 'selectedYard']) !!}
    </div>

    <div class="form-group">
        <strong>Vía</strong>
        @error('tracks')
        <small class="text-danger">
            <strong>{{$message}}</strong>
        </small>
        @enderror
        {!! Form::select('track_id', [0 => 'Seleccione una opción'] + $tracks, $selectedTrack, ['class' => 'form-control','wire:model' => 'selectedTrack']) !!}
    </div>
</div>