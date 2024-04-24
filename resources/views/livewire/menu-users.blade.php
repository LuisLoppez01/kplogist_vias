<div>
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <input wire:keydown="limpiar_page()" wire:model="search" class="form-control w-100" type="text" placeholder="Escriba un nombre">
        </div>
        <div class="class-header">
            <a href="{{route('menu.users.create')}}" class="btn btn-primary ml-4 mt-2" >Registrar usuario</a>
        </div>
        @if ($users->count())
            <div class="card-body table-responsive">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Empresa</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->company->name}}</td>
                            <td width='10px'>
                                <a class="btn btn-primary" href="{{route('menu.users.edit', $user)}}">Editar</a>
                            </td>
                            <td width='10px'>
                                {!! Form::model($user,['route'=> ['menu.users.destroy',$user], 'method' => 'delete']) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
{{--                            <a class="btn btn-danger" href="{{route('menu.users.destroy', $user)}}">Eliminar</a>--}}{{----}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer table-responsive">
                {{$users->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No existe el registro solicitado...</strong>
            </div>
        @endif

    </div>
</div>
