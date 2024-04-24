@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Crear tipo de carro</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'menu.cartypes.store']) !!}
                @include('menu.cartypes.partials.form')
                
                {!! Form::submit('Agregar, ['class' => 'btn btn-primary mt-2']) !!}

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