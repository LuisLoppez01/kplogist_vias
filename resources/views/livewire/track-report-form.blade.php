
<div x-data="{ optionYard: '', optionTrack:''}">
    <div class="row d-flex justify-content-end">
        <div class="form-group col-12 col-sm-4">
            <strong class="d-flex justify-content-center">Usuario</strong>
            @error('users')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
            @enderror
            {!! Form::text('name', $user->name, ['class' => 'form-control','readonly' => true]); !!}
        </div>
    </div>
    <div class="form-group col-12" x-data="{ selectedOption: null }">
        <strong>Condición (Opcional)</strong>
        <div class="row">
            <div class="form-group col-6">
                {!! Form::radio('condition', '0', false, ['x-on:click'=>'selectedOption === \'0\' ? selectedOption = null : selectedOption = \'0\'', 'x-model'=>'selectedOption']) !!}
                {!! Form::label('condition', 'OK') !!}
            </div>
            <div class="form-group col-6">
                {!! Form::radio('condition', '1', false, ['x-on:click'=>'selectedOption === \'1\' ? selectedOption = null : selectedOption = \'1\'', 'x-model'=>'selectedOption']) !!}
                {!! Form::label('condition', 'BO') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-10">
            <div class=" d-flex flex-row align-items-center justify-content-between">
                <strong class="mr-3">Patios:</strong>
                @error('yards')
                <small class="text-danger">
                    <strong>{{$message}}</strong>
                </small>
                @enderror
                {!! Form::select('yard_id', [0 => 'TODO'] + $yards, null, ['x-model'=>'optionYard', 'placeholder'=> 'Selecciona una opción','required'=>'required','class' =>'form-control','style'=>'width:50rem','wire:model' => 'selectedYards']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-10" x-show="optionYard !== '0'">
            <div class=" d-flex flex-row align-items-center justify-content-between">
                <strong class="mr-3">Vías:</strong>
                @error('tracks')
                <small class="text-danger">
                    <strong>{{$message}}</strong>
                </small>
                @enderror
                {!! Form::select('track_id', [0 => 'TODO'] + $tracks , null, ['x-model'=>'optionTrack','id' => 'track', 'placeholder'=> 'Selecciona una opción','class' =>'form-control','style'=>'width:50rem','wire:model' => 'selectedTracks']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-10" x-show="optionYard !== '0' && optionTrack !=='0'"  >
            <div class="d-flex flex-row align-items-center justify-content-between">
                <strong class="mr-3">Tramos de vías:</strong>
                @error('tracksections')
                <small class="text-danger">
                    <strong>{{$message}}</strong>
                </small>
                @enderror
                {!! Form::select('tracksection_id', [0 => 'TODO'] + $tracksections , null, ['id' => 'track', 'placeholder'=> 'Selecciona una opción','class' =>'form-control', 'style'=>'width:50rem']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="input-group col-10 d-flex justify-content-between">
            <div class="col-6">
                <strong class="mr-3">Fecha inicial:</strong> <!-- Fecha de inicio -->
                {!! Form::date('initial_date', null, ['class' => 'form-control','max'=>$currentDateTime]) !!}
            </div>
            <div class="col-6">
                <strong class="mr-3">Fecha final:</strong> <!-- Fecha final -->
                {!! Form::date('final_date', null, ['class' => 'form-control','max'=>$currentDateTime]) !!}
            </div>
        </div>
    </div>
    {{--@dump($selectedYards,$selectedTracks)--}}
</div>
