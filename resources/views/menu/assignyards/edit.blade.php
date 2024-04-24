@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Asignar patio</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">

            {!! Form::model($user,['route'=> ['menu.assignyards.update',$user], 'method' => 'put']) !!}
            @include('menu.assignyards.partials.form')

            {!! Form::submit('Asignar patios', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
