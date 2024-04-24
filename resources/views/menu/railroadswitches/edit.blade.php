@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Editar herraje</h1>
@stop

@section('content')
    @if (session('info'))
            <div class="alert alert-success" role="alert">
                <strong>Éxito!</strong> {{session('info')}}
            </div>
        @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($railroadswitch,['route'=> ['menu.railroadswitches.update',$railroadswitch], 'method' => 'put']) !!}
                @include('menu.railroadswitches.partials.form')
                
                {!! Form::submit('Actualizar herraje', ['class' => 'btn btn-primary mt-2']) !!}

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