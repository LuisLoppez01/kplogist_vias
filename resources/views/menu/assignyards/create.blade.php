@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Asignar patio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            {!! Form::open(['route'=> 'menu.assignyards.store']) !!}


            {!! Form::submit('Registrar vía', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
