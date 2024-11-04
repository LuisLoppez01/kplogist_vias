@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="font-bold">Bienvenido</h1>
@stop

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif

    @foreach($yardsData as $yard)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Inspecciones - {{ $yard['yard_name'] }}</h3>
            </div>
            <div class="card-body">
                <!-- Gráfico de Tracksections -->
                <div class="chart-container">
                    <canvas id="tracksectionsPieChart_{{ $yard['yard_id'] }}"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="tracksectionsConditionChart_{{ $yard['yard_id'] }}"></canvas>
                </div>

                <!-- Gráfico de RailroadSwitches -->
                <div class="chart-container">
                    <canvas id="railroadSwitchesPieChart_{{ $yard['yard_id'] }}"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="railroadSwitchesConditionChart_{{ $yard['yard_id'] }}"></canvas>
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .chart-container {
            position: relative;
            width: 100%;
            height: 300px; /* Altura del gráfico */
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 200px; /* Altura menor para dispositivos móviles */
            }
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($yardsData as $yard)
                // Datos para Tracksections
                var tracksectionsData = {
                    total: {{ $yard['tracksections']['total'] }},
                    without_inspection: {{ $yard['tracksections']['without_inspection'] }},
                    condition_0: {{ $yard['tracksections']['condition_0'] }},
                    condition_1: {{ $yard['tracksections']['condition_1'] }},
                };

                // Gráfico de Dona para Tracksections
                var ctxTracksections = document.getElementById('tracksectionsPieChart_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxTracksections, {
                    type: 'doughnut',
                    data: {
                        labels: ['Inspecciones Realizadas', 'Sin Inspección'],
                        datasets: [{
                            label: 'Tracksections',
                            data: [
                                tracksectionsData.total - tracksectionsData.without_inspection,
                                tracksectionsData.without_inspection
                            ],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)', // Color para Inspecciones Realizadas
                                'rgba(255, 99, 132, 0.6)'  // Color para Sin Inspección
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)', // Borde para Inspecciones Realizadas
                                'rgba(255, 99, 132, 1)'  // Borde para Sin Inspección
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });

                // Gráfico de barras para condiciones de Tracksections
                var ctxTracksectionsCondition = document.getElementById('tracksectionsConditionChart_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxTracksectionsCondition, {
                    type: 'bar',
                    data: {
                        labels: ['Condición 0', 'Condición 1'],
                        datasets: [{
                            label: 'Condiciones de Tracksections',
                            data: [tracksectionsData.condition_0, tracksectionsData.condition_1],
                            backgroundColor: [
                                'rgba(255, 206, 86, 0.6)', // Color para condición 0
                                'rgba(75, 192, 192, 0.6)'  // Color para condición 1
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });

                // Datos para RailroadSwitches
                var railroadSwitchesData = {
                    total: {{ $yard['railroadSwitches']['total'] }},
                    without_inspection: {{ $yard['railroadSwitches']['without_inspection'] }},
                    condition_0: {{ $yard['railroadSwitches']['condition_0'] }},
                    condition_1: {{ $yard['railroadSwitches']['condition_1'] }},
                };

                // Gráfico de Dona para RailroadSwitches
                var ctxRailroadSwitches = document.getElementById('railroadSwitchesPieChart_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxRailroadSwitches, {
                    type: 'doughnut',
                    data: {
                        labels: ['Inspecciones Realizadas', 'Sin Inspección'],
                        datasets: [{
                            label: 'RailroadSwitches',
                            data: [
                                railroadSwitchesData.total - railroadSwitchesData.without_inspection,
                                railroadSwitchesData.without_inspection
                            ],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)', // Color para Inspecciones Realizadas
                                'rgba(255, 99, 132, 0.6)'  // Color para Sin Inspección
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)', // Borde para Inspecciones Realizadas
                                'rgba(255, 99, 132, 1)'  // Borde para Sin Inspección
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });

                // Gráfico de barras para condiciones de RailroadSwitches
                var ctxRailroadSwitchesCondition = document.getElementById('railroadSwitchesConditionChart_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxRailroadSwitchesCondition, {
                    type: 'bar',
                    data: {
                        labels: ['Condición 0', 'Condición 1'],
                        datasets: [{
                            label: 'Condiciones de RailroadSwitches',
                            data: [railroadSwitchesData.condition_0, railroadSwitchesData.condition_1],
                            backgroundColor: [
                                'rgba(255, 206, 86, 0.6)', // Color para condición 0
                                'rgba(75, 192, 192, 0.6)'  // Color para condición 1
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });
            @endforeach
        });
    </script>
@stop
