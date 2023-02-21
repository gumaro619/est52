@extends('adminlte::page')

@section('title', 'Docentes')

@section('content_header')
    <h1 class="text-center">
        <span class="text-primary">
            <i class="fas fa-chalkboard-teacher"></i>
        </span>
        Panel principal de Docentes
    </h1>
    {{ $docente }}

    <p style="text-align: center;" class="fs-5">Bienvenid@ 
        {{-- este es el dashboard --}}
        <strong>
            {{ $docente->trabajador->persona->apellido_p }}  {{ $docente->trabajador->persona->apellido_m ?? '' }}  {{ $docente->trabajador->persona->nombre[0] }}.
        </strong>
        al Sistema integral de información de la EST 52.
    </p>
@stop

@section('content')
    <div id="cajaMiniDashboard">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Alumnos</span>
                        <span class="info-box-number">{{ $totalUsers ?? 'sin datos' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success">
                        <i class="fas fa-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Clases</span>
                        <span class="info-box-number">{{ $docente->clases->count() ?? 'sin datos' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning">
                        <i class="fas fa-exclamation-circle"></i></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Alumnos sin calificar</span>
                        <span class="info-box-number">{{ $totalRevenue ?? 'sin datos' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger">
                        <i class="fas fa-clipboard-list"></i></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Reportes </span>
                        <span class="info-box-number">{{ $docente->trabajador->reportes->count() ?? 'sin datos' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="fs-5">A continuación dispone de las opciones principales </p>



    <div class="container">
        <div class="row">
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Generar y cosultar  avisos,  faltas y/o  llamados de atención del alumndado a cargo</p>
                    <a href="/docente/reportes/{{ $docente->id }}" class="btn btn-primary stretched-link">Generar reporte</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">HORARIOS</h5>
                    <p class="card-text">Consultar  Horario actual de trabajo</p>
                    <a href="/horarios" class="btn btn-primary stretched-link">Consultar Horario</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Expedietne</h5>
                    <p class="card-text">Expediente de calificaciones y listas durante el ciclo actual : {{ date("Y")."-".date("Y")+1 }} </p>
                    <a href="/boletas" class="btn btn-primary stretched-link">Consultar expediente</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">ASIGNACIÓN DE CALIFICACIONES</h5>
                    <p class="card-text">Asignación de calificaciones del alumnado a cargo (periodo ordinario) ciclo escolar: {{ date("Y")."-".date("Y")+1 }}</p>
                    <a href="/docente/calificaciones/" class="btn btn-primary stretched-link">Asignar calificaciones</a>
                </div>
            </div>

        </div>
    </div>


    <p class="fs-5">Relación de GRUPOS A CARGO</p>
    
    <table id="grupos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">CICLO</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->id }}</td>
                    <td>{{ $grupo->nombre }}</td>
                    <td>{{ $grupo->ciclo }}</td>
                    <td>
                        <a href="/grupos/{{ $grupo->id }}/edit" class="btn btn-info">Editar</a>
                    </td>
                    
                </tr>
            @empty
                <p>NO HAY DATOS PARA MOSTRAR</p>
            @endforelse
        </tbody>
    </table>


@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        .errores{
            color: rgb(173, 14, 14);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#grupos').DataTable();
        });

        $('#grupos').DataTable( {
            language: {
                search: "Buscar:",
                lengthMenu:"Mostrar _MENU_ registros por página",
                zeroRecords:"No se encontró ningún registro",
                info: "Mostrando la página _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros disponibles",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                paginate: {
                    'next':'siguiente',
                    'previous':'anterior'
                }

            }
        } );
        
    </script>
@stop