@extends('modTutor.plantillaTutor')

@section('title', 'Tutorado')

@section('content_header')
    <div class="row g-3">
        <div class="col-md-1">
            <button class="btn btn-primary back-button" onclick="window.history.back();">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>
        <div class="col-md-10">
            <p class="fs-1" style="text-align: center">Datos de información reelevante </p>
        </div>
        <div class="col-md-1">
            
        </div>
    </div>
@stop

@section('content')

    <div class="alert alert-info" role="alert">
            Recuerde que puede consultar Todos los datos solamente del ciclo escolar vidente, Si requiere de información de ciclos anteriores  debe acudir  directamente a la institución a solicitarla.
    </div>

    <!-- .............------------------------*******************************************.CARD PRINCIPAL.............. -->
    <div class="card card-primary">
        <!-- ..............................................................HEADER.............. -->
        <div class="card-header"> 
            <div class="row g-3">
                <div class="col-md-10">
                    <h3 class="card-title fw-bold">{{$alumno->persona->nombre."  " .$alumno->persona->apellido_p." ".$alumno->persona->apellido_m ?? ''}}</h3>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-end">
                        <P class="fw-bold">{{ $grupo=$alumno->grupo->nombre ?? 'No asignado' }}</P>
                    </div>
                </div>
            </div>
        </div>



        <!-- ..............................................................BODY.............. -->
        <div class="card-body">
            @if($grupo=='No asignado')
                <div class="alert alert-danger" role="alert">
                    Al parecer {{ $alumno->persona->nombre }} no tiene registro en ningún grupo aún. Recuerde que éstos aparecerán una vez dé inicio el ciclo escolar oficial de acuerdo al calendario académico.
                </div>
            @else

            <!-- .................minidashboard.............. -->
            <div id="cajaMiniDashboard">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger">
                                <i class="fas fa-clipboard-list"></i></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Todos los reportes</span>
                                <span class="info-box-number">{{ $reportes=count($alumno->reportes) ?? 'sin datos' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning">
                                <i class="fas fa-exclamation-circle"></i></i></span>
                            <div class="info-box-content">
                                @php
                                    $puntosAcum=0;
                                    foreach ($alumno->reportes as $reporte) {
                                        $puntosAcum+=$reporte->puntaje;
                                    }
                                @endphp
                                <span class="info-box-text">Puntos de conduta Acumulados</span>
                                <span class="info-box-number">{{ $puntosAcum ?? 'sin datos' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info">
                                <i class="fas fa-book-open"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total de clases</span>
                                <span class="info-box-number">{{ count($clases=$alumno->grupo->clases) ?? 'sin datos' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success">
                                <i class="fas fa-chart-line"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Calificaciones reportadas</span>
                                <span class="info-box-number">{{ count($alumno->calificaciones) ?? 'sin datos' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- .................reportes.............. -->
            <section id="reportes" style="background-color: rgb(238, 238, 255)">
                <p class="fs-1">Reportes</p>
                @if($reportes==0)
                    <div class="alert alert-success" role="alert">
                        Enhorabuena¡ {{ $alumno->persona->nombre }} no tiene registros de reporte este ciclo¡
                    </div>
                @else
                    <div class="historialReportes">
                        <table id="tablaReportes" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">PUNTAJE</th>
                                    <th scope="col">ASUNTO</th>
                                    <th scope="col">OBSERVACIONES</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">ALUMNO</th>
                                    <th scope="col">AREA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" value="{{ $totalPuntos=0; }}">
                                @forelse($alumno->reportes as $reporte)
                                <tr>
                                    <td>{{ $reporte->id }}</td>
                                    <td>{{ $reporte->puntaje}}</td>
                                    <td>{{ $reporte->asunto}}</td>
                                    <td>{{ $reporte->observaciones}}</td>
                                    <td>{{ $reporte->fecha}}</td>
                                    <td>{{ $reporte->alumno_id}}</td>
                                    <td>{{ $reporte->trabajador->puesto ?? 'General'}}</td>
                                    <input type="hidden" value="{{ $totalPuntos+=$reporte->puntaje; }}">
                                </tr>
                                @empty
                                <p class="fs-4">No hay reportes registrados</p>
                                @endforelse
                                <p class="fs-3">Total de puntos de conducta: {{ $totalPuntos }}</p>
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <!-- ....................horario........... -->
            <div class="horarioClases" style="display: block">
                <br>
                <p class="fs-1">Horario de clases  {{ $alumno->grupo->nombre }}</p>
                @php
                    $horarios = array();
                        $strClases='';
                        foreach ($clases->sortBy('horaE') as $clase) {
                        $strClases=$strClases."- ".$clase->materia->nombre."(".$clase->horaE.")"."       ";
                        $horarios[]=$clase->horaE;
                    }
                @endphp

                <div class="col-md">
                    <label for="inputCity" class="form-label">Clases:</label>
                    <input type="text" class="form-control" id="f1clase" name="f1clase" style="text-align: center" value="{{$strClases}}" disabled>
                </div>


                <table id="tablaHorario" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Hora/Día</th>
                            <th scope="col">LUNES</th>
                            <th scope="col">MARTES</th>
                            <th scope="col">MIERCOLES</th>
                            <th scope="col">JUEVES</th>
                            <th scope="col">VIERNES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clases->sortBy('horaE') as $clase)
                        <tr>
                            <td>{{ substr($clase->horaE, 0, 5)." a ".substr($clase->horaS, 0, 5) }}</td>
                            <td>@if(str_contains($clase->dias, "L"))
                                <div class="d-flex justify-content-center">
                                    <p>{{ $clase->materia->nombre }}</p>
                                </div>
                                @endif</td>
                            <td>@if(str_contains($clase->dias, "M"))
                                <div class="d-flex justify-content-center">
                                    <p>{{ $clase->materia->nombre }}</p>
                                </div>
                                @endif</td>
                            <td>@if(str_contains($clase->dias, "W"))
                                <div class="d-flex justify-content-center">
                                    <p>{{ $clase->materia->nombre }}</p>
                                </div>
                                @endif</td>
                            <td>@if(str_contains($clase->dias, "J"))
                                <div class="d-flex justify-content-center">
                                    <p>{{ $clase->materia->nombre }}</p>
                                </div>
                                @endif</td>
                            <td>@if(str_contains($clase->dias, "V"))
                                <div class="d-flex justify-content-center">
                                    <p>{{ $clase->materia->nombre }}</p>
                                </div>
                                @endif</td>
                        </tr>
                        @if($clase->horaS=='09:30:00'||$clase->horaS=='12:30:00')
                        <tr style="background-color: rgb(228, 239, 255)">
                            <td style="text-align: center;">R</td>
                            <td style="text-align: center;">E</td>
                            <td style="text-align: center;">C</td>
                            <td style="text-align: center;">E</td>
                            <td style="text-align: center;">S</td>
                            <td style="text-align: center;">O</td>
                        </tr>
                        @endif
                        @empty
                        <p class="fs-4"> Al parecer no hay clases asignadas aún</p>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <!-- .............calificaciones.................. -->
            <section id="calificaciones">
                <div class="calificaciones" style="display: block">
                    <br>
                    <p class="fs-1">Calificaciones</p>
                </div>

                <table id="tablaCalificaciones" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">MATERIA</th>
                            <th scope="col">Calif 1</th>
                            <th scope="col">faltas 1</th>
                            <th scope="col">Calif 2</th>
                            <th scope="col">faltas 2</th>
                            <th scope="col">Calif 3</th>
                            <th scope="col">faltas 3</th>
                            <th scope="col">Promedio</th>
                            <th scope="col">Faltas</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($clases->sortBy('horaE') as $clase)
                        <tr>
                            <td>
                                <p>{{ $clase->materia->nombre }}</p>
                            </td>

                            <td>
                                <p style="text-align: center">{{ $cal1 = $clase->calificaciones->where('periodo',1)->where('alumno_id',$alumno->id)->first()->calificacion ?? 'sin reportar' }}</p>
                            </td>
                            <td>
                                <p style="text-align: center">{{ $fall = $clase->calificaciones->where('periodo',1)->where('alumno_id',$alumno->id)->first()->faltas ?? 'sin reportar' }}</p>
                            </td>

                            <td>
                                <p style="text-align: center">{{ $cal2 = $clase->calificaciones->where('periodo',2)->where('alumno_id',$alumno->id)->first()->calificacion ?? 'sin reportar' }}</p>
                            </td>
                            <td>
                                <p style="text-align: center">{{ $fal2 = $clase->calificaciones->where('periodo',2)->where('alumno_id',$alumno->id)->first()->faltas ?? 'sin reportar' }}</p>
                            </td>

                            <td>
                                <p style="text-align: center">{{ $cal3 = $clase->calificaciones->where('periodo',3)->where('alumno_id',$alumno->id)->first()->calificacion ?? 'sin reportar' }}</p>
                            </td>
                            <td>
                                <p style="text-align: center">{{ $fal3 = $clase->calificaciones->where('periodo',3)->where('alumno_id',$alumno->id)->first()->faltas ?? 'sin reportar' }}</p>
                            </td>
                            @php
                            try {
                            $calf = ($cal1+$cal2+$cal3)/3;
                            $faltasf=$fall+$fal2+$fal3;
                            } catch (Throwable $e) {
                            $calf ='-';
                            $faltasf='-';
                            }
                            @endphp
                            <td>
                                <p style="text-align: center">{{ Str::substr($calf, 0, 3) }}</p>
                            </td>
                            <td>
                                <p style="text-align: center">{{ $faltasf }}</p>
                            </td>

                        </tr>
                        @empty
                        <p>Parece que no tiene materias registradas</p>
                        @endforelse

                    </tbody>
                </table>
            </section>
            @endif
        </div>

        <!-- ..............................................................FOOTER.............. -->
        <div class="card-footer">
        </div>
    </div>
    
@stop

@section('estilos')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        .fs-1{
            text-align: center;
        }
    </style>
@stop

@section('jscript')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaReportes').DataTable();
        });

        $('#tablaReportes').DataTable( {
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
    <script>
        function ocultarReporte(idReporte){
            document.getElementById(idReporte).style.display = "none";
        }
        function setPuntos(puntos){
            document.getElementById('idReporte').style.display = "none";
        }
    </script>
@stop