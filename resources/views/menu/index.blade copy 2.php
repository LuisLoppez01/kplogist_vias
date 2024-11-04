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

    <!-- Gráfico Circular de Inspecciones -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Número de Inspecciones</h3>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="inspectionPieChart"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        var ctx = document.getElementById('inspectionPieChart').getContext('2d');
        var inspectionPieChart = new Chart(ctx, {
            type: 'pie', // Tipo de gráfico circular
            data: {
                labels: ['BO', 'OK'], // Etiquetas para los estados
                datasets: [{
                    label: 'Inspecciones',
                    data: [10, 20], // Datos estáticos: 10 para BO, 20 para OK
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', // Color para BO
                        'rgba(54, 162, 235, 0.6)'  // Color para OK
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',   // Borde para BO
                        'rgba(54, 162, 235, 1)'   // Borde para OK
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Para permitir que se ajuste al contenedor
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw; // Muestra la etiqueta y el valor
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value, context) {
                            var total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            var percentage = ((value / total) * 100).toFixed(2) + '%'; // Calcular porcentaje
                            return value + ' (' + percentage + ')'; // Retornar el número y el porcentaje
                        },
                        color: '#fff', // Color del texto
                    }
                }
            },
            plugins: [ChartDataLabels] // Incluir el plugin de datalabels
        });
    </script>
@stop
