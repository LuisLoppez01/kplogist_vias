@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Agregar lista de correos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'menu.emails.store']) !!}
                @include('menu.emails.partials.form')


                {!! Form::submit('Registrar correos', ['class' => 'btn btn-primary mt-2']) !!}

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
