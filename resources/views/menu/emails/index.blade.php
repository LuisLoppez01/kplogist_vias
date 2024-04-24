@extends('adminlte::page')

@section('title', 'FFCC')


@section('content_header')
    <h1>Lista de correos</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{route('menu.emails.create')}}" class="btn btn-primary">Registrar correos</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patio</th>
                        <th >Lista de correos</th>
                        <th >
                    </tr>
                </thead>
                <tbody>
                    @forelse ($emails as $email)
                        <tr>
                            <td>{{$email->id}}</td>
                            <td >{{$email->yard->name}}</td>
                            <td >
                                <div class="badge  text-wrap text-sm" style="width: 30rem;">
                                    {{$email->list}}
                                  </div>
                            </td>
                            <td width='10px'><a class="btn btn-secondary" href={{route('menu.emails.edit',$email)}}>Editar</a></td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay ningún correo registrado</td>
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