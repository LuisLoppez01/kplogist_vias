@extends('adminlte::page')

@section('title', 'FFCC')


@section('content_header')
    <h1>Asignar Patio</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Estado</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->yards->isEmpty() ? 'Patios no asignados' : 'Patios Asignados'}}</td>
                        <td width='150px'><a class="btn btn-primary" href={{route('menu.assignyards.edit', $user)}}>Modificar</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay ningún patio asignado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{$users->links()}}
            </div>
        </div>
    </div>
@stop
