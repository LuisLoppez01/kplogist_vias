<div>
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
        {{--<div class="card-header">

            <a href="{{route('menu.inspections.create')}}" class="btn btn-primary">Registrar Tramo</a>

        </div>--}}
        <div class="card-header">

            <input wire:keydown="limpiar_page()" wire:model="search" class="form-control w-100" type="text"
                   placeholder="Escriba un nombre">
            {!! Form::select('company_id', [0 => 'Selecciona una opción'] + $companies, null, ['id' => 'company_id','class' => 'form-control','wire:model' => 'companySearch']) !!}
            {!! Form::select('yard_id', [0 => 'Selecciona una opción'] + $yards, null, ['id' => 'yard_id','class' => 'form-control','wire:model' => 'search']) !!}
            @dump($yardsIds)
            @dump($ds)
            @dump($inspections)

        </div>

        <div class="card-body table-responsive">
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
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($inspections as $inspection)
                    <tr>
                        <td>{{$inspection->id}}</td>
                        <td>{{$inspection->user->name}}</td>
                        <td>{{$inspection->yard->company->name}}</td>
                        @if ($inspection->type_inspection==1)
                            <td>Inspeccion de Vía</td>
                        @elseif($inspection->type_inspection==2)
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
                        {{--    <td>{{$inspection->yard->location->name}}</td>  --}}
                        <td width='10px'><a class="btn btn-secondary"
                                            href={{route('menu.inspections.edit',$inspection)}}>Editar</a></td>
                        <td width='10px'>
                            @can('delete', $inspection)
                                <form action="{{route('menu.inspections.destroy',$inspection)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                        {{--  @if ($inspection->image)
                        <td> {{Storage::url($inspection->image->url)}}</td>
                        @else
                        <td> Sin foto</td>
                        @endif  --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No hay registro de inspecciones</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{$inspections->links()}}
            </div>
        </div>
    </div>
</div>
