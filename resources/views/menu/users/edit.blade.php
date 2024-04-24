@extends('adminlte::page')

@section('title', 'DashboardTITLE')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" role="alert">
            <strong>Éxito!</strong> {{session('info')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($user,['route'=> ['menu.users.update',$user], 'method' => 'put']) !!}
            @include('menu.users.partials.form')
{{--            @livewire('form-users')--}}
            {!! Form::submit('Actualizar usuario', ['class' => 'btn btn-primary mt-2']) !!}
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
