@extends('adminlte::page')

@section('title', 'FFCC')


@section('content_header')
    <h1>Lista de Iniciales</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Exito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{route('menu.initials.create')}}" class="btn btn-primary">Registar iniciales</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($initials as $initial)
                        <tr>
                            <td>{{$initial->id}}</td>
                            <td>{{$initial->name}}</td>
                            <td width='10px'><a class="btn btn-secondary" href={{route('menu.initials.edit',$initial)}}>Editar</a></td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No hay ningún empresa registrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
