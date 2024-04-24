<div x-data="{ selectedOption: '{{ $inspection->type_inspection }}' }" class="p-3 pt-5">

    @if (session('info'))
        <div id="Alert" class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{ session('info') }}
        </div>
    @endif

    @if (session('error'))
        <div id="Alert" class="alert alert-danger" role="alert">
            <strong>ERROR!</strong> {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="form-group col-12 col-sm-4">
            <strong>InspectorR</strong>
            @error('users')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
            @enderror
            {!! Form::text('name', $user->name, ['class' => 'form-control','readonly' => true]); !!}
        </div>
        <div class="form-group col-12 col-sm-4">
            <strong>Tipo de inspeccion</strong>
            <div class="row">
                @if ($inspection->type_inspection==1)
                    <div class="form-group col-6">
                        {!! Form::radio('type_inspection', '1', true, ['wire:model'=>'selectedComponent','x-model' => 'selectedOption','id'=>'via']) !!}
                        {!! Form::label('type_inspection', 'Vía') !!}
                    </div>
                @endif
                @if ($inspection->type_inspection==2)
                    <div class="form-group col-6">
                        {!! Form::radio('type_inspection', '2', false,['wire:model'=>'selectedComponent','x-model' => 'selectedOption','id'=>'herraje']) !!}
                        {!! Form::label('type_inspection', 'Herraje') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group col-12 col-sm-4">
            <strong>Fecha</strong>
            @error('tracksections')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
            @enderror
            {{ Form::text('date', $inspection->date, ['class' => 'form-control','readonly' => true]) }}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12 col-sm-4">
            <strong>Patios</strong>
            @error('yards')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
            @enderror
            {!! Form::select('yard_id', [0 => 'Selecciona una opción'] + $yards, null, ['id' => 'yard_id','class' => 'form-control','wire:model' => 'selectedYard']) !!}
        </div>
        <div class="form-group col-12 col-sm-4" x-show="selectedOption === '1'">
            <strong>Vía</strong>
            @error('tracks')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
            @enderror
            {!! Form::select('track_id', $tracks=['0' => 'Selecciona una opción'] + $tracks, null, ['id' => 'track_id','class' => 'form-control','wire:model' => 'selectedTrack']) !!}
        </div>
        <div class="form-group col-12 col-sm-4" x-show="selectedOption === '1'">
            <strong>Tramos</strong>
            @error('tracksections')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
            @enderror
            {!! Form::select('tracksection_id', ['0' => 'Selecciona una opción'] +$tracksections, $inspection->tracksection_id ? $inspection->tracksection_id : null, ['id' => 'tracksection_id','class' => 'form-control']) !!}
        </div>

        <div class="form-group col-12 col-sm-4" x-show="selectedOption === '2'">
            <strong>Herraje</strong>
            @error('railroadswitches')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>

            @enderror
            {!! Form::select('railroadswitch_id', [0 => 'Selecciona una opción'] + $railroadswitches , $inspection->railroadswitch_id ? $inspection->railroadswitch_id : null, ['id' => 'railroadswitch_id','class' => 'form-control']) !!}
        </div>
    </div>
    <div x-data="{ mostrarSeccion: '{{ $inspection->condition }}' }">
        <div class="row">
            <div class="form-group col-12 col-sm-4">
                <strong>Condición</strong>
                <div class="row">
                    <div class="form-group col-6">
                        {{$inspection->condition == 0}}
                        {{--                        {!! Form::radio('type_inspection', '2', false,['wire:model'=>'selectedComponent','x-model' => 'selectedOption','id'=>'herraje']) !!}--}}
                        {!! Form::radio('condition',  0, $inspection->condition == 0 ? true : false, ['x-model' => 'mostrarSeccion', 'id' => 'conditionOK']) !!}
                        {!! Form::label('condition', 'OK') !!}
                    </div>
                    <div class="form-group col-6">
                        {{$inspection->condition == 1}}
                        {!! Form::radio('condition', 1,  $inspection->condition == 1 ? true : false,['x-model' => 'mostrarSeccion', 'id' => 'conditionBO']) !!}
                        {!! Form::label('condition', 'BO') !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-12 col-sm-4">
            </div>
            <div class="form-group col-12 col-sm-4">
            </div>
        </div>
        <div class="row p-5" x-show="mostrarSeccion === '1'">
            @if($conjuntos !== null)
                <div class="col-12">
                    <div class="row" name="primera-fila">
                        <div class="form-group col-12 col-sm-4">
                            <label class="etiqueta-escritorio" for="priorities">Componente</label>
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label class="etiqueta-escritorio" for="priorities">Prioridad</label>
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label class="etiqueta-escritorio" for="priorities">Comentario</label>
                        </div>
                    </div>

                    @foreach ($conjuntos as $index => $conjunto)
                        <div class="row">
                            <!-- Agrega aquí los elementos select y el campo de comentarios -->
                            <div class="form-group col-12 col-sm-4">
                                <label class="etiqueta-movil" x-text="'Componente ' + {{ $index +1}}"
                                       for="defecto"></label>
                                <select name="defecto[]" id="defectos_id_{{ $index }}" class="form-control" {{$index < $lenghtDefect ? '': 'wire:model=conjuntos.'.$index.'.defecto'}}>
                                    <option value="0">Selecciona una opción</option>
                                    @foreach ($components as $id => $name)
                                        <option
                                            {{$index < $lenghtDefect ? $inspection->defect_track[$index]->component_catalogs_id == $id ? 'selected' : '': ''}} value="{{ $id }}">{{ $name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-4">
                                <label class="etiqueta-movil" x-text="'Proridad ' + {{ $index +1}}"
                                       for="priorities"></label>
                                <select name="priorities[]" id="priority_id_{{ $index }}" class="form-control">
                                    <option value="0">Selecciona una opción</option>
                                    <option
                                        value="1" {{$index < $lenghtDefect ? $inspection->defect_track[$index]->priority == 1 ? 'selected' : '': ''}}>
                                        Baja
                                    </option>
                                    <option
                                        value="2"{{$index < $lenghtDefect ? $inspection->defect_track[$index]->priority == 2 ? 'selected' : '': ''}}>
                                        Media
                                    </option>
                                    <option
                                        value="3"{{$index < $lenghtDefect ? $inspection->defect_track[$index]->priority == 3 ? 'selected' : '': ''}}>
                                        Alta
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-4">
                                <label class="etiqueta-movil" x-text="'Comentario ' + {{ $index +1}}"
                                       for="comments"></label>
                                <input type="text" name="comments[]"
                                       value="{{$index < $lenghtDefect ? $inspection->defect_track[$index]->comment : ''}}"
                                       placeholder="Agregar comentario" class="form-control">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 d-flex justify-content-end">
                    @if (count($conjuntos) > 1)
                        <button wire:click="eliminarConjunto({{ $index }})" class="btn btn-danger">Eliminar defecto
                        </button>
                    @endif
                    <button wire:click="agregarConjunto" class="btn btn-success">Agregar defecto <i
                            class='fas fa-plus-circle'></i></button>
                </div>
            @else

            @endif
        </div>
    </div>
    <div class="row ">
        <div class="form-group col-12 col-sm-4">
            {!! Form::label('file', 'Evidencia gráfica (opcional)'); !!}
            {!! Form::file('file', ['class'=>'form-control-file','accept' => 'image/*']); !!}
        </div>
        <div class="form-group col-12 col-sm-8">
            <div class="image-wrapper">
                <img id="evidencia" src=" {!! asset('img/kp_tracks.jpg') !!}">
            </div>
        </div>
    </div>

    @if (session('info') or session('error'))
        <script>
            // Esperar 5 segundos (5000 milisegundos) y ocultar la alerta
            setTimeout(function () {
                $("#Alert").fadeOut(1000); // Opción de efecto de desvanecimiento, en este caso 1 segundo (1000 milisegundos)
            }, 3000);
        </script>
    @endif
</div>

