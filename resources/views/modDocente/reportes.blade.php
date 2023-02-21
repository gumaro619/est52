@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1 class="text-center" id="titulo">
        <span class="text-danger">
            <i class="fas fa-clipboard-list"></i>
        </span>
        Reportes del alumnado
    </h1>
    <a href="/docente/{{ $docente->id }}" class="btn btn-primary btn-lg">Regresar al panel principal</a>
@stop

@section('content')

    <div id="caja">
        <p class="fs-2">Hola de nuevo¡</p>
    </div>
    
    
    <div class="cajaFormulario" id="cajaFormulario"  @if ($errors->any())
        style="display: block"
    @else
        style="display: none"
    @endif>
        <div class="alert alert-warning" role="alert">
            * ATENCIÓN no podrá editar ni borrar  reportes una vez creados
        </div>
        Datos del reporte:
        <form action="/docente/reportes" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col">
                    <label for="" class="form-label" >Asunto del reporte : </label>
                    <input type="text" class="form-control" name="asunto" id="asunto" value="{{ old('asunto') }}" tabindex="1">
                    @error('asunto')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
                </div>
                <div class="col">
                    <label for="" class="form-label" >Fecha : </label>
                    <input type="text" class="form-control" name="fecha" id="fecha" value="{{ old('fecha',now()->toDateString()) }}" readonly >
                </div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label" tabindex="-1">AlumnoID: </label>
                <input type="text" class="form-control" id="alumno_id" name="alumno_id" readonly>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Estudiante: </label>
                <input type="text" class="form-control" id="alumno" name="alumno" readonly>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Puntaje: </label>
                <br>
                <small>Sugerencias:</small>
                <div class="form-check form-check-inline">
                    <button type="button" class="btn btn-secondary" onclick="setPuntos(1)">1 punto</button>
                    <label class="form-check-label" for="radio1Punto"> (penalización baja o llamado de atención)</label>
                </div>

                <div class="form-check form-check-inline">
                    <button type="button" class="btn btn-warning" onclick="setPuntos(3)">3 puntos</button>
                    <label class="form-check-label" for="radio3Puntos"> (penalización media o reincidencias)</label>
                    
                </div>

                <div class="form-check form-check-inline">
                    <button type="button" class="btn btn-danger" onclick="setPuntos(5)">5 puntos</button>
                    <label class="form-check-label" for="radio5Puuntos"> (falta grave, queda en el expediente)</label>
                </div>

                <input type="number" class="form-control" min="1" max="10" step="1" name="puntaje" id="puntaje" value="{{ @old('puntaje','1') }}" tabindex="3">
                @error('puntaje')
                    <small class="puntaje">*{{ $message }}</small>
                    <br>
                @enderror
                
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Descripción del reporte: </label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Descripción detallada del reporte" value="{{ old('observaciones') }}" tabindex="4"></textarea>
                @error('observaciones')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>

            
            <div class="mb-3">
                <label for="" class="form-label" tabindex="5">Trabajador: </label>
                <input type="text" class="form-control" id="trabajador_id" name="trabajador_id" readonly value="{{ $docente->trabajador->id }}">
            </div>

            <div class="mb-3">
                <label for="" class="form-label" tabindex="5">Trabajador: </label>
                <input type="text" class="form-control" id="docente_id" name="docente_id" readonly value="{{ $docente->id }}">
            </div>
            
            <button type="submit" class="btn btn-primary" tabindex="4" tabindex="6">Generar el reporte</button>
            <a href="/docente/reportes/{{ $docente->id }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
            <a class="btn btn-success" onclick="mostrarAlumnos()">Elegir otro alumno</a>
        </form>
    </div>

    <div class="cajaAlumnos" id="cajaAlumnos" @if ($errors->any())
        style="display: none"
    @else
        style="display: block"
    @endif>
        <div class="alert alert-warning" role="alert">
            Busque y Seleccione un Alumno para generar un reporte rápidamente
        </div>
        <table id="alumnos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO P.</th>
                    <th scope="col">APELLIDO M.</th>
                    <th scope="col">GRUPO</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id}}</td>
                        <td>{{ $alumno->persona->nombre}}</td>
                        <td>{{ $alumno->persona->apellido_p}}</td>
                        <td>{{ $alumno->persona->apellido_m}}</td>
                        <td>{{ $alumno->grupo->nombre ?? 'no asignado'}}</td>

                        <td>
                            <a class="btn btn-info"  onclick="setInfo({{ $alumno->id }},'{{ $alumno->persona->nombre.' '.$alumno->persona->apellido_p.' '.$alumno->persona->apellido_m}}')">Seleccionar</a>
                        </td>
                        
                        
                    </tr>
                @empty
                    <p>NO HAY DATOS PARA MOSTRAR</p>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="cajaReportes" @if ($errors->any())
        style="display: none"
    @else
        style="display: block"
    @endif>
        <table id="reportes" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ALUMNO</th>
                    <th scope="col">PUNTAJE</th>
                    <th scope="col">ASUNTO</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">TRABAJADOR</th>

                </tr>
            </thead>
            <tbody>
                @forelse($docente->trabajador->reportes as $reporte)
                    <tr>
                        <td>{{ $reporte->id }}</td>
                        <td>{{ $reporte->fecha}}</td>
                        <td>{{ $reporte->alumno_id ? : 'no asignado'}}</td>
                        <td>{{ $reporte->puntaje}}</td>
                        <td>{{ $reporte->asunto}}</td>
                        <td>{{ $reporte->observaciones}}</td>
        
                        <td>{{ $reporte->trabajador_id ? : 'No asignado'}}</td>

                    </tr>
                    @empty
                    <p>NO HAY DATOS PARA MOSTRAR</p>
                @endforelse
            </tbody>
        </table>
    </div>

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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#alumnos').DataTable();
            
        });


        $('#alumnos').DataTable( {
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
        function setPuntos($puntos){
            document.getElementById('puntaje').value=$puntos;
        }

        function setInfo(id,nombre){

            document.getElementById('alumno_id').value=id;
            document.getElementById('alumno').value=nombre;

            document.getElementById("cajaFormulario").style.display = "block";
            document.getElementById("cajaReportes").style.display = "none";
            document.getElementById("cajaAlumnos").style.display = "none";
            document.getElementById('asunto').disabled = false;
            document.getElementById('observaciones').disabled = false;
            document.getElementById('puntaje').disabled = false;
            document.getElementById('asunto').disabled = false;
            document.getElementById('asunto').focus();
        }

        function mostrarAlumnos(){
            document.getElementById("cajaAlumnos").style.display = "block";
            document.getElementById('asunto').disabled = true;
            document.getElementById('observaciones').disabled = true;
            document.getElementById('puntaje').disabled = true;
            document.getElementById('asunto').disabled = true;
            document.getElementById("cajaFormulario").style.display = "none";
        }


        function ocultarTutores() {
            document.getElementById("caja").style.display = "none";
            document.getElementById("caja2").style.display = "block";
        }
    </script>
@stop