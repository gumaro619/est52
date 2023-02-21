@extends('adminlte::page')

@section('title', 'Mi Dashboard')

@section('content_header')
    <h1 class="text-center">
        <span class="text-primary my-3">
            <i class="fas fa-compass"></i>
        </span>
        Panel principal de Orientación Académica
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">
                        <i class="fas fa-user-graduate"></i> Total de Alumnos
                    </h3>
                </div>
                <div class="card-body bg-light-primary">
                    <h1 class="text-center text-primary">500</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="card-title text-white">
                        <i class="fas fa-user-check"></i> Alumnos Activos
                    </h3>
                </div>
                <div class="card-body bg-light-success">
                    <h1 class="text-center text-success">450</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title">
                        <i class="fas fa-user-times"></i> Alumnos Inactivos
                    </h3>
                </div>
                <div class="card-body bg-light-warning">
                    <h1 class="text-center text-warning">50</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-danger">
                    <h3 class="card-title text-white">
                        <i class="fas fa-user-slash"></i> Alumnos Suspendidos
                    </h3>
                </div>
                <div class="card-body bg-light-danger">
                    <h1 class="text-center text-danger">0</h1>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">
                        <i class="fas fa-chart-pie"></i> Estadísticas de Alumnos
                    </h3>
                </div>
                <div class="card-body bg-light-primary">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top 5 productos más vendidos</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>Producto</th>
                        <th>Ventas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            <tr>
                            <td>{{ $alumno->persona->nombre }}</td>
                            <td>{{ $alumno->persona->apellido_p }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">
                            <i class="fas fa-chart-pie"></i> Estadísticas de Alumnos
                        </h3>
                    </div>
                    <div class="card-body bg-light-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
    <!-- Agrega aquí los estilos que necesites -->
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Alumnos Activos', 'Alumnos Inactivos', 'Alumnos Suspendidos'],
                datasets: [{
                    data: [450, 50, 0],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@stop
