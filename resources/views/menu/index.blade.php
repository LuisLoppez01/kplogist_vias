@extends('adminlte::page')@section('title', 'DashboardTITLE')@section('content_header')    <h1 class="font-bold" >Bienvenido</h1>@stop@section('content')    @if(session('error'))        <div class="alert alert-danger">            <strong>Error!</strong> {{ session('error') }}        </div>    @endif@stop@section('css')    <link rel="stylesheet" href="/css/admin_custom.css">@stop@section('js')    <script> console.log('Hi!'); </script>@stop