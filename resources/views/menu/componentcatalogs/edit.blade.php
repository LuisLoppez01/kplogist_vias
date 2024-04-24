@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Editar vía</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($componentcatalog,['route'=> ['menu.componentcatalogs.update',$componentcatalog], 'method' => 'put']) !!}
            @include('menu.componentcatalogs.partials.form')

            {!! Form::submit('Actualizar componente', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
