<div>
    <div class="container">
    @if ($showModal)
            <div class="row">
                @foreach ($yards as $yard)
                    <div class="col-md-4 col-sm-6">
                        <div class="profile-card-2" wire:click='openModal1("{{ $yard->id }}")'>
                            <img src="{{ asset('img/Track.jpg') }}" width="300" class="img img-responsive">
                            <div class="profile-id">
                            </div>

                            <div class="profile-name"><span>{{ $yard->name }}</span></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @if ($showModal1)
        {{--<p>{{$this->selectedCardYardId}}</p>--}}
        <div class="card">
            <h5 class="card-header">Vias o Herrajes</h5>
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title">Vias</h5>
                </div>
                <div class="row">
                    @php
                        $alignedArray = [];
                    @endphp
                    @foreach ($tracks as $index => $track)
                        @php
                            $condition = ''; // Establecemos el valor predeterminado a 'bg-success'
                        @endphp
                        @php
                                $inspectionModel = new \App\Models\Inspection();
                                $condition = $inspectionModel->getTrackVerification($track,$condition);
                                $match = $this->inspectiontracks->firstWhere('track_id', $track->id);
                                $alignedArray[] = $match ? $match : null;
                                @endphp
                        <div class="col-md-4 col-sm-6">
                            <div class="btn {{ $condition }} btn-block mt-2"
                                 wire:click='openModal2("{{ $track->id }}")'>
                                <div class="profile-id">
                                    <span>Ultima inspección: {{isset($alignedArray[$index]) ? $alignedArray[$index]->date: 'No hay registro'}}</span>
                                </div>
                                <div class="profile-name"><span>{{ $track->name }}</span></div>
                                <div class="profile-username"><span>{{ $track->yard->name }}</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <h5 class="card-title mt-3">Herrajes</h5>
                </div>
                <div class="row">
                    @php
                        $alignedArray = [];
                    @endphp
                    @foreach ($railroadswitches as $index => $railroadswitch)
                        @php
                            $condition = ''; // Establecemos el valor predeterminado a 'bg-success'
                        @endphp
                        @php
                            $inspectionModel = new \App\Models\Inspection();
                            $condition = $inspectionModel->getRailraoadSwtichVerification($railroadswitch);;
                            $match = $this->inspectionrailroadswitchs->firstWhere('railroadswitch_id', $railroadswitch->id);
                            $alignedArray[] = $match ? $match : null;
                        @endphp
{{--                        @dump($match)--}}
                        <div class="col-md-4 col-sm-6">
                            <div class="btn {{ $condition }} btn-block mt-2"
                                 wire:click="openModal3({{ $railroadswitch->id }},'switch')">

                                <div class="profile-id">
                                    <span>Ultima inspección: {{isset($alignedArray[$index]) ? $alignedArray[$index]->date: 'No hay registro'}}</span>
                                </div>
                                <div class="profile-name"><span>{{ $railroadswitch->name }}</span></div>
                                <div class="profile-username"><span>{{ $railroadswitch->yard->name }}</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer" style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-info" data-dismiss="modal" wire:click="closeModal1"><i
                        class='fas fa-reply'></i> Regresar
                </button>
            </div>
        </div>
    @endif

    @if ($showModal2)
        <div class="card">
            <h5 class="card-header">Tramos de vía</h5>
            <div class="card-body">
                <div class="row">
                    @foreach ($tracksections as $tracksection)
                        @php
                            $inspectionModel = new \App\Models\Inspection();
                            $condition = $inspectionModel->getTrackSectionVerification($tracksection);;
                        @endphp
                        <div class="col-lg-4 col-sm-6">
                            <div class="btn {{ $condition }} btn-block mt-2"
                                 wire:click="openModal3({{ $tracksection->id }},'tramo')">
                                <div class="profile-id">
                                    {{--                                    <span>{{ $tracksection->id }}</span>--}}
                                </div>
                                <div class="profile-name"><span>{{ $tracksection->name }}</span></div>
                                <div class="profile-username"><span>Tramo de vía</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer" style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-info" data-dismiss="modal" wire:click="closeModal2"><i
                        class='fas fa-reply'></i> Regresar
                </button>
            </div>
        </div>
    @endif

    @if ($showModal3)
        <div class="card">
            <h5 class="card-header">Listado de inspecciones</h5>
            <div class="card-body">
                <div class="row">
                    <table style="text-align: center" class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Empresa</th>
                            <th>Tipo de inspección</th>
                            <th>Patio</th>
                            <th>Vía \ Herraje</th>
                            <th>Tramo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($inspections->sortByDesc('id') as $inspection)
                            <tr>
                                <td>{{ $inspection->id }}</td>
                                <td>{{ $inspection->user->name }}</td>
                                <td>{{ $inspection->yard->company->name }}</td>
                                @if ($inspection->type_inspection == 0)
                                    <td>Inspeccion de Vía</td>
                                @else
                                    <td>Inspeccion de Herraje</td>
                                @endif
                                <td>{{ $inspection->yard->name }}</td>
                                @if ($inspection->track_id)
                                    <td>{{ $inspection->track->name }}</td>

                                    <td>{{ $inspection->tracksection->name }}</td>
                                @else
                                    <td>{{ $inspection->railroadswitch->name }}</td>
                                    <td></td>
                                @endif
                                <td width='10px'>
                                    <button class="btn btn-primary"
                                            wire:click="openModal4({{ $inspection->id }})">Ver Inspección
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No hay registro de inspecciones</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer" style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-info" data-dismiss="modal" wire:click="closeModal3"><i
                        class='fas fa-reply'></i> Regresar
                </button>
            </div>
        </div>
    @endif

    @if ($showModal4)
        <div class="card">
            <h5 class="card-header">Detalle de inspeccion</h5>
            <div class="card-body">
                <div class="container">
                    @if ($selectedInspection)
                        <div class="card shadow ml-lg-4 mr-lg-4  mt-1">
                            <div class="card-header">Inspección {{ $selectedInspection[0]->id }}</div>
                            <h5></h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 col-sm-4">
                                        <strong>Inspector</strong>
                                        {{ Form::text('user', $selectedInspection[0]->user->name, ['class' => 'form-control', 'readonly' => true]) }}

                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <strong>Tipo de inspección</strong>
                                        <div class="row">
                                            @if ($selectedInspection[0]->tracksection_id)
                                                <div class="form-group col-6">
                                                    {!! Form::radio('type_inspection', '1', true) !!}
                                                    {!! Form::label('type_inspection', 'Vía') !!}
                                                </div>
                                            @endif
                                            @if ($selectedInspection[0]->railroadswitch_id)
                                                <div class="form-group col-6">
                                                    {!! Form::radio('type_inspection', '2', true) !!}
                                                    {!! Form::label('type_inspection', 'Herraje') !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <strong>Fecha</strong>
                                        @error('tracksections')
                                        <small class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                        @enderror
                                        {{ Form::text('date', $selectedInspection[0]->date, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-sm-4">
                                        <strong>Patio</strong>
                                        {{ Form::text('yard', $selectedInspection[0]->yard->name, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
                                    @if (isset($selectedInspection[0]->track->name))
                                        <div class="form-group col-12 col-sm-4">
                                            <strong>Vía</strong>
                                            {{ Form::text('track', $selectedInspection[0]->track->name, ['class' => 'form-control', 'readonly' => true]) }}
                                        </div>
                                        <div class="form-group col-12 col-sm-4">
                                            <strong>Tramos</strong>
                                            {{ Form::text('tracksection', $selectedInspection[0]->tracksection->name, ['class' => 'form-control', 'readonly' => true]) }}
                                        </div>
                                    @endif
                                    @if (isset($selectedInspection[0]->railroadswitch->name))
                                        <div class="form-group col-12 col-sm-4">
                                            <strong>Herraje</strong>
                                            {{ Form::text('railroadswitch', $selectedInspection[0]->railroadswitch->name, ['class' => 'form-control', 'readonly' => true]) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-sm-4">
                                        <strong>Condición</strong>
                                        <div class="row">
                                            @if ($selectedInspection[0]->condition == 0)
                                                <div class="form-group col-6">
                                                    {!! Form::radio('condition', '0', true) !!}
                                                    {!! Form::label('condition', 'OK') !!}
                                                </div>
                                            @endif
                                            @if ($selectedInspection[0]->condition == 1)
                                                <div class="form-group col-6">
                                                    {!! Form::radio('condition', '1', true) !!}
                                                    {!! Form::label('condition', 'BO') !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if ($selectedInspection[0]->condition == 1)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row" name="primera-fila">
                                                <div class="form-group col-12 col-sm-4">
                                                    <label class="etiqueta-escritorio" for="defect">Defecto</label>
                                                </div>
                                                <div class="form-group col-12 col-sm-4">
                                                    <label class="etiqueta-escritorio"
                                                           for="priority">Prioridad</label>
                                                </div>
                                                <div class="form-group col-12 col-sm-4">
                                                    <label class="etiqueta-escritorio"
                                                           for="comment">Comentario</label>
                                                </div>
                                            </div>
                                            @foreach ($selectedInspection[0]->defect_track as $defect)
                                                <div class="row">
                                                    <!-- Agrega aquí los elementos select y el campo de comments -->
                                                    <div class="form-group col-12 col-sm-4">
                                                        <label class="etiqueta-movil" for="defect">Defectos</label>
                                                        {{ Form::text('defect', is_null($defect->component_catalogs_id)?"No se agregó componente":$defect->component_catalog->name, ['class' => 'form-control', 'readonly' => true]) }}
                                                    </div>
                                                    <div class="form-group col-12 col-sm-4">
                                                        <label class="etiqueta-movil" for="priority">Prioridad</label>
                                                        {{ Form::text('priority', $priorityOptions[$defect->priority], ['class' => 'form-control', 'readonly' => true]) }}
                                                    </div>
                                                    <div class="form-group col-12 col-sm-4">
                                                        <label class="etiqueta-movil"
                                                               for="defect">Comentario</label>
                                                        {{ Form::text('comment', is_null($defect->comment)?"No se agregó comentario":$defect->comment, ['class' => 'form-control', 'readonly' => true]) }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if ($selectedInspection[0]->image)
                                    <div class="row mt-5">
                                        <div class="form-group col-12 col-sm-4">
                                            <label>Evidencia gráfica:</label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center align-items-center">
                                        <figure class="ml-lg-5 mr-lg-5">
                                            <img src="{{ asset('storage/'.$selectedInspection[0]->image->url) }}"
                                                 alt="Imagen de inspección" class="img-fluid img-max-600">
                                        </figure>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer  d-flex justify-content-end ">
                                {{--
                                                                <a href="#" class="btn btn-primary">Descargar cotizacion**</a>
                                --}}
                            </div>
                        </div>
                    @else
                        <p>Aún no cuenta con inspecciones</p>
                    @endif
                </div>
            </div>
            <div class="card-footer" style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-info" data-dismiss="modal" wire:click="closeModal4"><i
                        class='fas fa-reply'></i> Regresar
                </button>
            </div>
        </div>
    @endif
    <style>
        /* Estilos para la imagen */

        .img-max-600 {

            max-width: 100%;
            /* La imagen ocupa todo el ancho del contenedor */

        }


        /* Estilos para pantallas grandes */

        @media (min-width: 992px) {

            .img-max-600 {

                max-width: 600px;
                /* Tamaño máximo de 600px en pantallas grandes */

            }

        }
    </style>

</div>
