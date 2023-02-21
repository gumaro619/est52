<?php
use Carbon\Carbon;
?>

@extends('adminlte::page')

@section('title', 'Orientación_Ac.')

@section('content_header')
{{-- Se recibe  array de NOMBRES DE ALUMNOS para el selest, el TRABAJADOR MODELO, y  ARRAR DEL DASHBOARDs del dashboard --}}
    <h1 class="text-center fs-1">
        <span class="text-primary">
            <i class="fas fa-compass"></i>
        </span>
        Orientación Académica
    </h1>
    <p style="text-align: center;" class="fs-5">
        Bienvenid@  <b>
                        {{ $trabajador->persona->apellido_p }} {{ $trabajador->persona->apellido_m ?? '' }} {{ $trabajador->persona->nombre[0] }}.
                    </b>
        al Sistema integral de información de la EST 52.
    </p>
@stop

@section('content')

    <div id="cajaCards">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3" id="cardAlumnosLista" data-trabajador-id="{{$trabajador->id}}">
                    <div class="card border-hover-effect">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-school"></i> Total de Alumnos
                            </h3>
                        </div>
                        <div class="card-body bg-light-primary">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('trabajador.alumnos.lista', ['trabajador_id' => $trabajador->id]) }}" class="btn btn-light btn-sm stretched-link">
                                    {{-- <i class="fa fa-eye"></i> --}}
                                </a>
                                <div class="col-md-4">
                                    <h1 class="text-center text-primary">{{ $info['alumnos'] }}</h1>
                                </div>
                                <div class="col-md-6" style="background-color: rgb(232, 232, 255)">
                                    <p class="text-center text-primary fs-3" style="margin: 0">{{ $info['tutores'] }} <i class="fas fa-user-friends"></i></p>
                                    <p class="fw-bold" style="text-align: center;margin: 0">tutores</p>
                                </div>                                  
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card" class="border-hover-effect border">
                        <div class="card-header bg-success">
                            <h3 class="card-title text-white">
                                <i class="fas fa-user-check"></i> Alumnos Activos
                            </h3>
                        </div>
                        <div class="card-body bg-light-success">
                            <h1 class="text-center text-success">{{ $info['activos'] }}</h1>
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
                            <h1 class="text-center text-danger">{{ $info['suspendidos'] }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title">
                                <i class="fas fa-user-times"></i> Alumnos Inactivos / otros
                            </h3>
                        </div>
                        <div class="card-body bg-light-warning">
                            <h1 class="text-center text-secondary">{{ $info['otros'] }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="cajaReportes">
        <div class="row">
            {{-- primera mitad del 2drow --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary d-flex justify-content-center">
                        <p class="card-title text-white" style="text-align: center">
                            <i class="fas fa-backpack"></i>BÚSQUEDA RÁPIDA
                        </p>
                    </div>
                    <div class="card-body bg-light-primary">
                        @include('modTrabajador.widgetBuscador', ['alumnos' => $alumnos])
                    </div>
                </div>
            </div>
            {{-- segunda mitad del 2row --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning d-flex justify-content-center">
                        <p class="card-title fs-7" style="text-align: center">ÚLTIMOS {{ count($topReportes) }} REPORTES REGISTRADOS</p>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Asunto</th>
                                <th>Estudiante</th>
                                <th>Creación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topReportes as $reporte)
                                <tr>
                                    <td>
                                        @php
                                            $puestoTrabajador=$reporte->trabajador->puesto ?? 'desconocido';
                                        @endphp
                                        @if($puestoTrabajador=='ORIENTADOR')
                                            Orient. Ac.
                                        @elseif($puestoTrabajador=='PREFECTO')
                                            Prefectura
                                        @else
                                            Gral.
                                        @endif</td>
                                    <td>{{ $reporte->asunto }}</td>
                                    <td>{{ $reporte->alumno->persona->nombre }}</td>
                                    <td>
                                        @php
                                            $created=$reporte->created_at ?? '';
                                            try {
                                                $fechaReporte = Carbon::parse($reporte_created_at);
                                                $fechaActual = Carbon::now();
                                                $diferencia = $fechaReporte->diff($fechaActual);
                                                $diferenciaEnDias = $diferencia->days;
                                            } catch (Throwable $e) {
                                                $diferenciaEnDias = $created;
                                            }
                                        @endphp
                                        {{   $diferenciaEnDias }}
                                    </td>
                                    <td>
                                        <a href="{{ route('trabajador.reportes.actualizar', ['reporte_id' => $reporte->id, 'trabajador_id' => $trabajador->id]) }}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div>
            <div id="cajaMiniDashboardReportes" data-trabajador-id="{{$trabajador->id}}">
                @include('modWidgets.miniCardsReportes', ['info' => $info])
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

        {{-- añadimos Select2 a partir de esta vista, --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .btnCardReportes {
            border: 1px solid rgb(190, 190, 190);
        }

        .btnCardReportes:hover {
            border-color: rgb(242, 193, 16);
            box-shadow: 0 0 10px  #bd883e;
        }

        .btnBloqueado {
            border: 1px solid rgb(213, 213, 213);
        }

        .btnBloqueado:hover {
            border-color: rgb(192, 11, 11);
            box-shadow: 0 0 10px  #ae0300;
        }

        .border-hover-effect {
            transition: border-color 0.3s ease-in-out; /* aplicamos una transición para el cambio de borde */
        }

        .border-hover-effect:hover {
            border-color: #4e89f0; /* cambiamos el color del borde en hover */
            box-shadow: 0 0 10px #22296b; /* agregamos una sombra para lograr el efecto de iluminación */
        }

        .errores{
            color: #ae0300;
        }

    </style>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            // Obtener el div por su ID cardRep1
            //var div = document.getElementById("cajaMiniDashboardReportes");
            var div = document.getElementById("cardRep1");
            // Obtener el valor del atributo data-tutor-id del div
            var tutorId = div.getAttribute("data-trabajador-id");
            // Agregar un listener de evento click al div
            div.addEventListener("click", function() {
                // Redirigir al usuario a otro sitio personalizado
                window.location.href = "/trabajador/reportes/" + tutorId ;
            });

        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#cajaMiniDashboardReportes').hover(
                function() {
                    $(this).css('background-color', 'yellow');
                }
                , function() {
                    $(this).css('background-color', 'white');
                }
            );
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#tablaMaterias').DataTable();
        });
        $('#tablaMaterias').DataTable( {
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
    </script> --}}
    
@stop