<div>
    <div class="form-group">
        {!! Form::label('name', 'Nombre: ') !!}
        {{--        {!! Form::text('name', null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}--}}
        {!! Form::text('name', $track?$track->name:$name, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Escriba un nombre']) !!}
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

    @if($route === 'create')
        <div class="form-group">
            {!! Form::label('type_track', 'Tipo de vía: ') !!}
            {!! Form::select('type_track',[""=>'Seleccione una opción'] + ['Clásica'=>'Clásica','Elástica'=>'Elástica','Clásica/Elástica'=>'Clásica/Elástica'] ,$type_track, ['class' => 'form-control'.($errors->has('type_track') ? ' is-invalid' : '')]) !!}
            @error('type_track')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
            @enderror
        </div>
        <div x-data="{ open: false }">
            <div style="gap: 30px" class="d-flex justify-content-between">
                <div style="width: 50%">{!! Form::label('tracksleeper', 'Durmientes') !!}</div>
                <div style="width: 50%">
                    <button @click.prevent="open = ! open" class="btn btn-primary">Agregar durmiente</button>
                </div>
            </div>
            <div style="gap: 30px" class="d-flex">
                <div style="width: 50%" class="form-group">
                    {!! Form::label('tracksleeper', 'Durmientes de vía') !!}
                    {!! Form::select('type_tracksleeper_one', [""=>'Seleccione una opción']+['Madera'=>'Madera','Concreto'=>'Concreto'], $type_tracksleeper_one, ['class' => ' mb-2 form-control'.($errors->has('type_tracksleeper_one') ? ' is-invalid' : '')]) !!}
                    {!! Form::text('lenght_tracksleeper_one',$lenght_tracksleeper_one, ['class' => 'form-control'.($errors->has('lenght_tracksleeper_one') ? ' is-invalid' : ''),'placeholder' => 'Escriba la cantidad de durmientes']) !!}

                    @error('type_tracksleeper_one')
                    <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    @error('lenght_tracksleeper_one')
                    <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <template x-if="open">

                    <div style="width: 50%">

                        {!! Form::label('tracksleeper', 'Durmientes de vía') !!}

                        {!! Form::select('type_tracksleeper_two', [""=>'Selecciona el tipo de durmiente','Madera'=>'Madera','Concreto'=>'Concreto'], $type_tracksleeper_two, ['class' => ' mb-2 form-control']) !!}

                        {!! Form::text('lenght_tracksleeper_two',$lenght_tracksleeper_two, ['class' => 'form-control'.($errors->has('lenght_tracksleeper_two') ? ' is-invalid' : ''),'placeholder' => 'Escriba la cantidad de durmientes']) !!}

                        @error('type_tracksleeper_two')
                        <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                        @enderror
                        @error('lenght_tracksleeper_two')
                        <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                        @enderror

                    </div>

                </template>


            </div>

        </div>



        <div x-data="{ open: false }">

            <div style="gap: 30px" class="d-flex justify-content-between">

                <div style="width: 50%">{!! Form::label('rails', 'Rieles') !!}</div>

                <div style="width: 50%">
                    <button @click.prevent="open = ! open" class="btn btn-primary">Agregar riel</button>
                </div>

            </div>

            <div style="gap: 30px" class="d-flex">

                <div style="width: 50%" class="form-group">

                    {!! Form::label('rails', 'Riel') !!}

                    {!! Form::select('weight_rails_one', [""=>'Selecciona el calibre del riel','80'=>'80 lbs/g','100'=>'100 lbs/g','110'=>'110 lbs/g','112'=>'112 lbs/g','115'=>'115 lbs/g','136'=>'136 lbs/g'], $weight_rails_one, ['class' => ' mb-2 form-control'.($errors->has('weight_rails_one') ? ' is-invalid' : '')]) !!}

                    {!! Form::text('lenght_rails_one', $lenght_rails_one, ['class' => 'form-control'.($errors->has('lenght_rails_one') ? ' is-invalid' : ''),'placeholder' => 'Escriba la longitud de vías']) !!}

                    @error('weight_rails_one')
                    <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    @error('lenght_rails_one')
                    <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <template x-if="open">

                    <div style="width: 50%" class="form-group">

                        {!! Form::label('rails', 'Riel') !!}

                        {!! Form::select('weight_rails_two', [""=>'Selecciona el calibre del riel','80'=>'80 lbs/g','100'=>'100 lbs/g','110'=>'110 lbs/g','112'=>'112 lbs/g','115'=>'115 lbs/g','136'=>'136 lbs/g'], $weight_rails_two, ['class' => ' mb-2 form-control']) !!}

                        {!! Form::text('lenght_rails_two', $lenght_rails_two, ['class' => 'form-control'.($errors->has('lenght_rails_two') ? ' is-invalid' : ''),'placeholder' => 'Escriba la longitud de vías']) !!}

                        @error('weight_rails_two')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                        @error('lenght_rails_two')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror

                    </div>

                </template>

            </div>

        </div>

    @else

        {{--sino, está en la vista edit--}}
        <div class="form-group">
            {!! Form::label('type_track', 'Tipo de vía: ') !!}
            {!! Form::select('type_track', [""=>'Selecciona el tipo de vía','Clásica'=>'Clásica','Elástica'=>'Elástica','Clásica/Elástica'=>'Clásica/Elástica'],$components->type_track , ['class' => 'form-control'.($errors->has('type_track') ? ' is-invalid' : '')]) !!}
            @error('type_track')
            <span class="invalid-feedback">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div x-data="{ open: false }">
            <div style="gap: 30px" class="d-flex justify-content-between">
                <div style="width: 50%">{!! Form::label('tracksleeper', 'Durmientes') !!}</div>
                <div style="width: 50%">
                    <button @click.prevent="open = ! open" class="btn btn-primary">Mostrar durmiente</button>
                </div>
            </div>

            <div style="gap: 30px" class="d-flex justify-content-around">
                <div style="width: 50%" class="form-group">
                    {!! Form::label('tracksleeper', 'Durmientes de vía') !!}
                    {!! Form::select('type_tracksleeper_one', [""=>'Selecciona el tipo de durmiente','Madera'=>'Madera','Concreto'=>'Concreto'], $components->type_tracksleeper_one, ['class' => ' mb-2 form-control'.($errors->has('type_tracksleeper_one') ? ' is-invalid' : '')]) !!}
                    {!! Form::text('lenght_tracksleeper_one',$components->lenght_tracksleeper_one, ['class' => 'form-control'.($errors->has('lenght_tracksleeper_one') ? ' is-invalid' : ''),'placeholder' => 'Escriba la cantidad de durmientes']) !!}
                    @error('type_tracksleeper_one')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                    @error('lenght_tracksleeper_one')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div style="width: 50%" class="form-group ">
                    <div x-show="open">
                        {!! Form::label('tracksleeper', 'Durmientes de vía') !!}
                        {!! Form::select('type_tracksleeper_two', [""=>'Selecciona el tipo de durmiente','Madera'=>'Madera','Concreto'=>'Concreto'], $components->type_tracksleeper_two, ['class' => ' mb-2 form-control']) !!}
                        {!! Form::text('lenght_tracksleeper_two',$components->lenght_tracksleeper_two, ['class' => 'form-control'.($errors->has('lenght_tracksleeper_two') ? ' is-invalid' : ''),'placeholder' => 'Escriba la cantidad de durmientes']) !!}
                    </div>
                    @error('type_tracksleeper_two')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                    @error('lenght_tracksleeper_two')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div x-data="{ open: false }">

            <div style="gap: 30px" class="d-flex justify-content-between">

                <div style="width: 50%">{!! Form::label('rails', 'Rieles') !!}</div>

                <div style="width: 50%">
                    <button @click.prevent="open = ! open" class="btn btn-primary">Mostrar riel</button>
                </div>

            </div>

            <div style="gap: 30px" class="d-flex justify-content-around">

                <div style="width: 50%" class="form-group">

                    {!! Form::label('rails', 'Riel 1') !!}

                    {!! Form::select('weight_rails_one', [""=>'Selecciona el calibre del riel','80'=>'80 lbs/g','100'=>'100 lbs/g','110'=>'110 lbs/g','112'=>'112 lbs/g','115'=>'115 lbs/g','136'=>'136 lbs/g'], $components->weight_rails_one, ['class' => ' mb-2 form-control'.($errors->has('weight_rails_one') ? ' is-invalid' : '')]) !!}

                    {!! Form::text('lenght_rails_one', $components->lenght_rails_one, ['class' => 'form-control'.($errors->has('lenght_rails_one') ? ' is-invalid' : ''),'placeholder' => 'Escriba la longitud de vías']) !!}

                    @error('weight_rails_one')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                    @error('lenght_rails_one')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror

                </div>

                <div style="width: 50%" class="form-group">

                    <div x-show="open">

                        {!! Form::label('rails', 'Riel 2') !!}

                        {!! Form::select('weight_rails_two', [""=>'Selecciona el calibre del riel','80'=>'80 lbs/g','100'=>'100 lbs/g','110'=>'110 lbs/g','112'=>'112 lbs/g','115'=>'115 lbs/g','136'=>'136 lbs/g'], $components->weight_rails_two, ['class' => ' mb-2 form-control']) !!}

                        {!! Form::text('lenght_rails_two', $components->lenght_rails_two, ['class' => 'form-control'.($errors->has('lenght_rails_two') ? ' is-invalid' : ''),'placeholder' => 'Escriba la longitud de vías']) !!}

                    </div>

                    @error('weight_rails_two')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                    @error('lenght_rails_two')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror

                </div>

            </div>

        </div>

    @endif
</div>
