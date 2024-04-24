@extends('adminlte::page')

@section('title', 'FFCC')


@section('content_header')
    <h1>Tipos de carros</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Exito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{route('menu.cartypes.create')}}" class="btn btn-primary">Registrar tipo</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cartypes as $cartype)
                        <tr>
                            <td>{{$cartype->id}}</td>
                            <td>{{$cartype->name}}</td>
                            <td>{{$cartype->description}}</td>
                            
                            <td width='10px'><a class="btn btn-secondary" href={{route('menu.cartypes.edit',$cartype)}}>Editar</a></td>
                            <td width='10px'>
                                <form action="{{route('menu.cartypes.destroy',$cartype)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay ningún rol registrado</td>
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