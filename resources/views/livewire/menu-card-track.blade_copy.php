<div>

    <div class="container">
        <div class="row">
            @foreach($yards as $yard)
                <div class="col-md-4 col-sm-6">
                    <div class="profile-card-2" wire:click="openModal1({{$yard->id}})">
                        <img src="{{ asset('img/Track.jpg') }}" width="300" class="img img-responsive">
                        <div class="profile-id">
                            <span>{{$yard->id}}</span>
                        </div>
                        <div class="profile-name"><span>{{$yard->name}}</span></div>
                        <div class="profile-username"><span>{{$yard->name}}</span></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if($showModal1)
        <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;" x-data x-on:close-modal.window="$wire.closeModal1()">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Vias o Herrajes</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" x-data x-on:click="$wire.closeModal1()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="m-3">
                            <div class="row">
                            <span>Vias</span>
                            </div>
                            <div class="row">
                                @foreach($tracks as $track)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="btn btn-success btn-block mt-2" wire:click="openModal2({{$track->id}})">
                                            <div class="profile-id">
                                                <span>{{$track->id}}</span>
                                            </div>
                                            <div class="profile-name"><span>{{$track->name}}</span></div>
                                            <div class="profile-username"><span>{{$track->yard->name}}</span></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                            <span class="mt-2">Herrajes</span>
                            </div>
                            <div class="row">
                                 @foreach($railroadswitches as $railroadswitch)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="btn btn-success btn-block mt-2" wire:click="openModal3({{$railroadswitch->id}},'switch')">
                                            <div class="profile-id">
                                                <span>{{$railroadswitch->id}}</span>
                                            </div>
                                            <div class="profile-name"><span>{{$railroadswitch->name}}</span></div>
                                            <div class="profile-username"><span>{{$railroadswitch->name}}</span></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" x-on:click="$wire.closeModal1()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    @if($showModal2)
        <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;" x-data x-on:close-modal.window="$wire.closeModal2()">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tramos de vía</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" x-data x-on:click="$wire.closeModal2()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                @foreach($tracksections as $tracksection)
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="btn btn-success btn-block mt-2" wire:click="openModal3({{$tracksection->id}},'tramo')">
                                                <div class="profile-id">
                                                <span>{{$tracksection->id}}</span>
                                            </div>
                                            <div class="profile-name"><span>{{$tracksection->name}}</span></div>
                                            <div class="profile-username"><span>Tramo de vía</span></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" x-on:click="$wire.closeModal2()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
    @if($showModal3)
         <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;" x-data x-on:close-modal.window="$wire.closeModal3()">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Listado de inspecciones</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" x-data x-on:click="$wire.closeModal3()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <table style="text-align: center" class="table table-striped">
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
                                            <td>{{$inspection->id}}</td>
                                            <td>{{$inspection->user->name}}</td>
                                            <td>{{$inspection->yard->company->name}}</td>
                                            @if ($inspection->type_inspection==0)
                                            <td>Inspeccion de Vía</td>
                                            @else
                                            <td>Inspeccion de Herraje</td>
                                            @endif
                                            <td>{{$inspection->yard->name}}</td>
                                            @if ($inspection->track_id)
                                            <td>{{$inspection->track->name}}</td>
                                            <td>{{$inspection->tracksection->name}}</td>
                                            @else
                                            <td>{{$inspection->railroadswitch->name}}</td>
                                            <td></td>
                                            @endif

                                            <td width='10px'>
                                                <button class="btn btn-primary" wire:click="openModal4({{$inspection->id}})"  >Detalle</button>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" x-on:click="$wire.closeModal3()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
    @if($showModal4)
         <div class="modal fade show" tabindex="-1" role="dialog" style="display: block;" x-data x-on:close-modal.window="$wire.closeModal4()">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Detalle de inspeccion</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" x-data x-on:click="$wire.closeModal4()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container ">
                            @if ($selectedInspection)
                                <div class="card">
                                    <div class="card-header">Inspección {{$selectedInspection[0]->id}}</div>
                                    <h5 ></h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-4">
                                                <strong>Inspector</strong>
                                                {{ Form::text('user', $selectedInspection[0]->user->name, ['class' => 'form-control','readonly' => true]) }}
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
                                                    <strong>{{$message}}</strong>
                                                </small>
                                                @enderror
                                                {{ Form::text('date', $selectedInspection[0]->date, ['class' => 'form-control','readonly' => true]) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-4">
                                                <strong>Patio</strong>
                                                {{ Form::text('yard', $selectedInspection[0]->yard->name, ['class' => 'form-control','readonly' => true]) }}
                                            </div>
                                            @if (isset($selectedInspection[0]->track->name))
                                            <div class="form-group col-12 col-sm-4" >
                                                <strong>Vía</strong>
                                                {{ Form::text('track', $selectedInspection[0]->track->name, ['class' => 'form-control','readonly' => true]) }}
                                            </div>
                                            <div class="form-group col-12 col-sm-4" >
                                                <strong>Tramos</strong>
                                                {{ Form::text('tracksection', $selectedInspection[0]->tracksection->name, ['class' => 'form-control','readonly' => true]) }}
                                            </div>
                                            @endif
                                            @if (isset($selectedInspection[0]->railroadswitch->name))
                                            <div class="form-group col-12 col-sm-4" >
                                                <strong>Herraje</strong>
                                                {{ Form::text('railroadswitch', $selectedInspection[0]->railroadswitch->name, ['class' => 'form-control','readonly' => true]) }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 col-sm-4">
                                                <strong>Condición</strong>
                                                <div class="row">
                                                    @if ($selectedInspection[0]->condition == 0 )
                                                    <div class="form-group col-6">
                                                        {!! Form::radio('condition', '0', true) !!}
                                                        {!! Form::label('condition', 'OK') !!}
                                                    </div>
                                                    @endif
                                                    @if ($selectedInspection[0]->condition == 1 )
                                                        <div class="form-group col-6">
                                                            {!! Form::radio('condition', '1',true) !!}
                                                            {!! Form::label('condition', 'BO') !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-sm-4">
                                            </div>
                                            <div class="form-group col-12 col-sm-4">
                                            </div>
                                        </div>
                                        @if ($selectedInspection[0]->condition == 1 )
                                        <div class="row" >
                                            <div class="col-12"  >
                                                <div class="row" name="primera-fila">
                                                    <div class="form-group col-12 col-sm-4">
                                                        <label class="etiqueta-escritorio" for="defect">Defecto</label>
                                                    </div>
                                                    <div class="form-group col-12 col-sm-4">
                                                        <label class="etiqueta-escritorio" for="priority">Prioridad</label>
                                                    </div>
                                                    <div class="form-group col-12 col-sm-4">
                                                        <label class="etiqueta-escritorio" for="comment">Comentario</label>
                                                    </div>
                                                </div>
                                                @foreach ($selectedInspection[0]->defect_track as $defect)
                                                    <div class="row">

                                                        <!-- Agrega aquí los elementos select y el campo de comments -->
                                                        <div class="form-group col-12 col-sm-4">

                                                            <label class="etiqueta-movil" for="defect">Defecto</label>
                                                            {{ Form::text('defect', $defect->component_catalogs, ['class' => 'form-control','readonly' => true]) }}
                                                        </div>
                                                        <div class="form-group col-12 col-sm-4">
                                                            <label class="etiqueta-movil" for="priority">Prioridad</label>
                                                            {{ Form::text('priority', $defect->priority, ['class' => 'form-control','readonly' => true]) }}
                                                        </div>
                                                        <div class="form-group col-12 col-sm-4">
                                                            <label class="etiqueta-movil" for="defect">Comentario</label>
                                                            {{ Form::text('comment', $defect->comment, ['class' => 'form-control','readonly' => true]) }}
                                                        </div>
                                                    </div>

                                                @endforeach

                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="card-footer  d-flex justify-content-end ">
                                        <a href="#" class="btn btn-primary">Descargar cotizacion**</a>
                                    </div>
                                </div>

                            @else
                                <p>Aún no cuenta con inspecciones</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" x-on:click="$wire.closeModal4()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>

    @endif

    <style>
        .modal-lg {
            max-width: 80% !important;
            margin: auto;
        }

        .modal-body {
            min-height: 300px;
            max-height: 65vh;
            overflow-y: auto;
        }
    </style>
</div>


