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
                <div class="row">
                    <!-- Fila 1: Gráficas de Tracksections -->
                    <div class="card col-md-4">
                        <h5 class="card-header">Avance de inspeccón de Vias</h5>
                        <div class="card-body">
                            <div >
                                <div class="chart-container">
                                    <canvas id="tracksectionsPieChart_{{ $yard['yard_id'] }}"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-4">
                        <h5 class="card-header">Inpecciones de vias</h5>
                        <div class="card-body">
                            <div >   
                                <div class="chart-container">
                                    <canvas id="tracksectionsConditionChart_{{ $yard['yard_id'] }}"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-4">
                        <h5 class="card-header">Defectos en inspecciones BO</h5>
                        <div class="card-body">
                            <div >  
                                <div class="chart-container">
                                    <canvas id="tracksectionsPieChartDefects_{{ $yard['yard_id'] }}"></canvas>
                                </div> 
                                {{-- <p>{{ $yard['yard_name'] }}</p>
                                <p>
                                    <pre>{{ json_encode($yard, JSON_PRETTY_PRINT) }}</pre>
                                </p> --}}
                            </div>
                        </div>
                    </div>

                    
                    
                </div>
                <div class="row">

                    <!-- Fila 2: Gráficas de RailroadSwitches -->
                    <div class="card col-md-4">
                        <h5 class="card-header">Avance de inspeccón de Herrajes</h5>
                        <div class="card-body">
                            <div >
                                <div class="chart-container">
                                    <canvas id="railroadSwitchesPieChart_{{ $yard['yard_id'] }}"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card col-md-4">
                        <h5 class="card-header">Inpecciones de Herrajes</h5>
                        <div class="card-body">
                            <div >
                                <div class="chart-container">
                                    <canvas id="railroadSwitchesConditionChart_{{ $yard['yard_id'] }}"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-4">
                        <h5 class="card-header">Defectos en inspecciones BO</h5>
                        <div class="card-body">
                            <div >
                                <div class="chart-container">
                                    <canvas id="railroadSwitchesPieChartDefects_{{ $yard['yard_id'] }}"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
            
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($yardsData as $yard)
                // Datos para Tracksections
                var tracksectionsData = {
                    total: {{ $yard['tracksections']['total'] }},
                    without_inspection: {{ $yard['tracksections']['without_inspection'] }},
                    condition_0: {{ $yard['tracksections']['condition_0'] }},
                    condition_1: {{ $yard['tracksections']['condition_1'] }},
                    priority_1: {{ $yard['tracksections']['defects_priority_counts']['priority_1']}},
                    priority_2: {{ $yard['tracksections']['defects_priority_counts']['priority_2']}},
                    priority_3: {{ $yard['tracksections']['defects_priority_counts']['priority_3']}},

                };

                console.log('trackSection'+ tracksectionsData.priority_3);
                

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
                        plugins: {
                            datalabels: {
                                color: '#fff',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                formatter: (value) => value,
                                align: 'center',
                                anchor: 'center'
                            }
                        }
                    },
                    plugins: [ChartDataLabels]  
                });

                // Gráfico de barras para condiciones de Tracksections
                var ctxTracksectionsCondition = document.getElementById('tracksectionsConditionChart_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxTracksectionsCondition, {
                    type: 'bar',
                    data: {
                        labels: ['Inspecciones OK', 'Inspecciones BO'],
                        datasets: [{
                            label: 'Condiciones de Tracksections',
                            data: [tracksectionsData.condition_0, tracksectionsData.condition_1],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)', // Color para Inspecciones Realizadas
                                'rgba(255, 99, 132, 0.6)'  // Color para condición 1
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });

                // Gráfico de Dona para Tracksections
                var ctxTracksections = document.getElementById('tracksectionsPieChartDefects_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxTracksections, {
                    type: 'doughnut',
                    data: {
                    
                        labels: ['Prioridad Baja', 'Prioridad Media', 'Prioridad Alta'],
                        datasets: [{
                            label: 'Tracksections',
                            data: [
                                tracksectionsData.priority_1,
                                tracksectionsData.priority_2,
                                tracksectionsData.priority_3
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(255, 99, 132, 0.7)',// Color
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)',// Borde para Sin Inspección
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            datalabels: {
                                color: '#fff',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                formatter: (value) => value,
                                align: 'center',
                                anchor: 'center'
                            }
                        }
                    },
                    plugins: [ChartDataLabels]                    
                });

                

                // Datos para RailroadSwitches
                var railroadSwitchesData = {
                    total: {{ $yard['railroadSwitches']['total'] }},
                    without_inspection: {{ $yard['railroadSwitches']['without_inspection'] }},
                    condition_0: {{ $yard['railroadSwitches']['condition_0'] }},
                    condition_1: {{ $yard['railroadSwitches']['condition_1'] }},
                    priority_1:  {{ $yard['railroadSwitches']['defects_priority_counts']['priority_1']}},
                    priority_2:  {{ $yard['railroadSwitches']['defects_priority_counts']['priority_2']}},
                    priority_3:  {{ $yard['railroadSwitches']['defects_priority_counts']['priority_3']}},

                };

                console.log('RAilSwitch'+railroadSwitchesData.priority_3);

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
                        plugins: {
                            datalabels: {
                                color: '#fff',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                formatter: (value) => value,
                                align: 'center',
                                anchor: 'center'
                            }
                        }
                    },
                    plugins: [ChartDataLabels]  
                });

                // Gráfico de barras para condiciones de RailroadSwitches
                var ctxRailroadSwitchesCondition = document.getElementById('railroadSwitchesConditionChart_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxRailroadSwitchesCondition, {
                    type: 'bar',
                    data: {
                        labels: ['Inspecciones OK', 'Inspecciones BO'],
                        datasets: [{
                            label: 'Condiciones de RailroadSwitches',
                            data: [railroadSwitchesData.condition_0, railroadSwitchesData.condition_1],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)', // Color para Inspecciones Realizadas
                                'rgba(255, 99, 132, 0.6)'  // Color para condición 1
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });

                // Gráfico de Dona para railroadSwitches
                var ctxRailroadSwitches = document.getElementById('railroadSwitchesPieChartDefects_{{ $yard['yard_id'] }}').getContext('2d');
                new Chart(ctxRailroadSwitches, {
                    type: 'doughnut',
                    data: {
                    
                        labels: ['Prioridad Baja', 'Prioridad Media', 'Prioridad Alta'],
                        datasets: [{
                            label: 'RailroadSwitches',
                            data: [
                                railroadSwitchesData.priority_1,
                                railroadSwitchesData.priority_2,
                                railroadSwitchesData.priority_3
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(255, 99, 132, 0.7)',// Color
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)',// Borde para Sin Inspección
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            datalabels: {
                                color: '#fff',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                formatter: (value) => value,
                                align: 'center',
                                anchor: 'center'
                            }
                        }
                    },
                    plugins: [ChartDataLabels]                    
                });






            @endforeach
        });
    </script>
@stop
