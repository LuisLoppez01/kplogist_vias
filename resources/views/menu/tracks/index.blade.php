@extends('adminlte::page')

@section('title', 'FFCC')


@section('content_header')
    <h1>Vías</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{session('info')}}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{route('menu.tracks.create')}}" class="btn btn-primary">Registrar Vía</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Patio</th>
                    <th>Componentes</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tracks as $track)
                    <tr>
                        {{--                            @dd($track->yard == null)--}}
                        <td>{{$track->id}}</td>
                        <td>{{$track->name}}</td>
                        <td>{{$track->yard == null ? 'No tiene patio' : $track->yard->name}}</td>
                        <td width='10px'><a class="btn btn-primary" data-toggle="modal"
                                            data-target=".showComponents{{$track->id}}-lg">Ver mas</a>
                            <div class="modal fade showComponents{{$track->id}}-lg" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Componentes</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Tipo de vía</label>

                                                <input type="text" name="name"
                                                       value="{{$track->component_track->type_track}}" disabled
                                                       class="form-control">
                                            </div>
                                            <label style="margin-left: 12px" for="">Durmientes</label>
                                            <div style="gap: 30px" class="d-flex justify-content-around">
                                                <div style="width: 45%" class="form-group">
                                                    <label for="">Durmiente de vía</label>
                                                    <input type="text" name="name"
                                                           value="{{$track->component_track->type_tracksleeper_one}}"
                                                           disabled class="mb-2 form-control">
                                                    <input type="text" name="name"
                                                           value="{{$track->component_track->lenght_tracksleeper_one}}"
                                                           disabled class="form-control">
                                                </div>
                                                <div style="width: 45%" x-data="{ type_tracksleeper_two: '{{$track->component_track->type_tracksleeper_two}}'
                                                    ,lenght_tracksleeper_two: '{{$track->component_track->lenght_tracksleeper_two}}'}">
                                                    <div
                                                        x-show="type_tracksleeper_two !== null && type_tracksleeper_two !== '' || lenght_tracksleeper_two !== null && lenght_tracksleeper_two !== ''">
                                                        <label for="">Durmiente de vía</label>
                                                        <input type="text" x-model="type_tracksleeper_two" disabled
                                                               class="mb-2 form-control">
                                                        <input type="text" x-model="lenght_tracksleeper_two" disabled
                                                               class="mb-2 form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <label style="margin-left: 12px" for="">Rieles</label>
                                            <div style="gap: 30px" class="d-flex justify-content-around">
                                                <div style="width: 45%" class="form-group">
                                                    <label for="">Riel 1</label>
                                                    <input type="text" name="name"
                                                           value="{{$track->component_track->weight_rails_one}} lbs/g"
                                                           disabled class="mb-2 form-control">
                                                    <input type="text" name="name"
                                                           value="{{$track->component_track->lenght_rails_one}}"
                                                           disabled class="form-control">
                                                </div>
                                                <div style="width: 45%" x-data="{ weight_rails_two: '{{$track->component_track->weight_rails_two}}'
                                                ,lenght_rails_two: '{{$track->component_track->lenght_rails_two}}'}"
                                                     class="form-group">
                                                    <div
                                                        x-show="weight_rails_two !== null && weight_rails_two !== '' || lenght_rails_two !== null && lenght_rails_two !== ''">
                                                        <label for="">Riel 2</label>
                                                        <input type="text" name="name"
                                                               value="{{$track->component_track->weight_rails_two}} lbs/g"
                                                               disabled class="mb-2 form-control">
                                                        <input type="text" name="name"
                                                               value="{{$track->component_track->lenght_rails_two}}"
                                                               disabled class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </td>
                        <td width='10px'><a class="btn btn-secondary"
                                            href={{route('menu.tracks.edit',$track)}}>Editar</a></td>
                        <td width='10px'>
                            @can('delete', $track)
                                <button
                                    onclick="Livewire.emit('confirmDeletion', '{{ route('menu.tracks.destroy', $track) }}')"
                                    class="btn btn-danger">
                                    Eliminar
                                </button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay ninguna vía registrada</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{$tracks->links()}}
            </div>
            @livewire('delete-confirmation-modal')
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
