@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'menu.roles.store']) !!}
                @include('menu.roles.partials.form')

                {!! Form::submit('Registrar rol', ['class' => 'btn btn-primary mt-2']) !!}

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
