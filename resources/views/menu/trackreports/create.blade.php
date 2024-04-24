@extends('adminlte::page')

@section('title', 'DashboardTITLE')

@section('content_header')
    <h1>Generar Reporte</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'menu.trackreports.store']) !!}
            @livewire('track-report-form')
            {!! Form::submit('Generar Reporte', ['class' => 'btn btn-primary mt-2']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop

