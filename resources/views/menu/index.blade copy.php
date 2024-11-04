@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="font-bold">Bienvenido</h1>
@stop

@section('content')
    <div class="row">
        <!-- Gráfico de Inspecciones -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Inspecciones</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="inspectionPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Tramos -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tramos Inspeccionados</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="tramosBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Defectos -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Últimos 5 Defectos</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="defectosBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        // Gráfico de Inspecciones
        var ctx1 = document.getElementById('inspectionPieChart').getContext('2d');
        var inspectionPieChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['BO', 'OK'],
                datasets: [{
                    data: [{{ $boCount }}, {{ $okCount }}],
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Gráfico de Tramos
        var ctx2 = document.getElementById('tramosBarChart').getContext('2d');
        var tramosBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Total Tramos', 'Tramos Inspeccionados'],
                datasets: [{
                    label: 'Tramos',
                    data: [{{ $totalTramos }}, {{ $tramosInspeccionados }}],
                    backgroundColor: ['rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Gráfico de Defectos
        var ctx3 = document.getElementById('defectosBarChart').getContext('2d');
        var defectosBarChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($defectos)) !!},
                datasets: [{
                    label: 'Defectos Reportados',
                    data: {!! json_encode(array_values($defectos)) !!},
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@stop
