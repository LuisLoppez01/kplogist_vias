@extends('adminlte::page')

@section('title', 'DashboardTITLE')

@section('content_header')
    <h1>Tarjeta Vías</h1>
@stop

@section('content')
    @livewire('menu-card-track')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/cards.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
