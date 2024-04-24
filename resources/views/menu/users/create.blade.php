@extends('adminlte::page')

@section('title', 'DashboardTITLE')

@section('content_header')
    <h1>Nuevo usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'menu.users.store']) !!}
            @include('menu.users.partials.form')
{{--            @livewire('form-users')--}}
            {!! Form::submit('Registrar usuario', ['class' => 'btn btn-primary mt-2']) !!}

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
