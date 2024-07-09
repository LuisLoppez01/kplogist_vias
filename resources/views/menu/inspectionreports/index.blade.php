@extends('adminlte::page')
@section('title', 'FFCC')
@section('content_header')
    <h1>Inspecciones Pendientes</h1>
@stop

@section('content')
    @livewire('inspection-report')
@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
