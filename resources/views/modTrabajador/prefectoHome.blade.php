@extends('modTrabajador.plantillaNoSlidebar')
{{-- EL REPORTE RÁPIDO  PRESCINDE DEL SLIDEBAR,  PRIORIZAMOS LA RAPIDEZ DE LA ENTRADA DE DATOS --}}
@section('title', 'Prefectura')
    
@section('content_header')
    <h1 class="text-center">
        <span class="text-primary">
            <i class="fa fa-user-circle"></i>
        </span>
        Panel principal Prefectura
    </h1>
    <p style="text-align: center;" class="fs-5">Bienvenid@ <b>{{ $trabajador->persona->apellido_p }} {{ $trabajador->persona->apellido_m ?? '' }} {{ $trabajador->persona->nombre[0] }}.</b> al Sistema integral de información de la EST 52.</p>

@stop

@section('content')
    <div>
        <div class="row g-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-center">
                    <a href="/trabajador" class="btn btn-danger">Salir de la sesión</a><br>
                    <a href="{{ route('trabajador.reportes.completo',$trabajador->id) }}" class="btn btn-primary">Ir al formulario completo</a>
                </div>
            </div>  
        </div>
        <br>
    </div>
    {{-- -----------------****************************************PRINCIPAL-------------HEADER --}}
    <div class="card card-primary">
        {{-- ------------------------------HEADER --}}
        <div class="card-header">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <h3 class="card-title fw-bold">FORMULARIO RÁPIDO DE GENERACIÓN DE REPORTES</h3>
                    </div>
                </div>  
            </div>
        </div>

        {{-- ------------------------------BODY --}}
        <div class="card-body">
            <br>
            <form action="{{ route('trabajador.reportar') }}" method="POST">
                @csrf
                <!--  datos ocultos  -->
                <input type="hidden" class="form-control" name="trabajador_id" id="trabajador_id" value="{{ $trabajador->id }}" >
        
        
                <div class="alert alert-info" role="alert">
                    Ingrese rápidamente  el nombre(s), apellidos y/o grupo  para seleccionar a un alumno, puede seleccionar uno o varios alumnos aantes de enviar el formulario
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-md-6" style="background-color: rgb(255, 231, 224)">
                        <div class="d-flex justify-content-center">
                            <select class="js-example-basic-multiple form-select form-select-lg mb-3" aria-label=".form-select-lg example" multiple="multiple" name="idAlumnos[]"> 
                                @foreach($alumnos as $alumno)
                                    <option value="{{ $alumno->id }}" @if(is_array(old('idAlumnos')) && in_array($alumno->id.'',old('idAlumnos')))
                                        selected
                                    @endif>
                                        {{ $alumno->persona->nombre }} {{ $alumno->persona->apellido_p }} {{ $alumno->persona->apellido_m ?? '' }} - {{ $alumno->grupo->nombre ?? '(sin grupo)' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @error('idAlumnos[]')
                    <p class="errores">*{{ $message }}</p>
                    <br>
                @enderror
                <div class="d-flex justify-content-center">
                    <div class="col-md-6">
                        <label for="" class="form-label">Asunto : </label>
                        <input type="text" class="form-control" name="asunto" id="asunto" value="{{ old('asunto','PENDIENTE') }}" placeholder="Indique el asunto del reporte" >
                        @error('asunto')
                            <p class="errores">*{{ $message }}</p>
                            <br>
                        @enderror
                    </div>  
                    <div class="col-md-6">
                        <label for="" class="form-label">Fecha (hoy): </label>
                        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha',now()->toDateString()) }}" >
                        @error('fecha')
                            <p class="errores">*{{ $message }}</p>
                            <br>
                        @enderror
                    </div>        
                </div>
                <br>
                
                <br>
                <div id="btns" class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg" tabindex="">Generar reporte(s) rápido(s)</button>
                </div>
                
            </form>
        
            <div id="info">
                <br>
                <div>
                    <div class="alert alert-warning" role="alert">
                        El formulario rápido de reportes le permite crear reportes ágilmente  guardando sólo la información primordial, Una vez guardados tendrá la oportunidad de describir los detalles de la misma
                    </div>
                </div>
            </div>
        
            <div id="cajaNotificaciones">
                <div id="caja1Reportes" >
                    <div class="container">
                        <div class="row">
                            <div>
                                <div class="alert alert-danger" role="alert">
                                    A continuación, detalle las observaciones y el puntaje de cada uno, o en su defecto guarde el formato simple.
                                </div>
                            </div>
                            @forelse($trabajador->reportes->sortByDesc('created_at'); as $reporte)
                                @if($reporte->created_at !== null && $reporte->created_at==$reporte->updated_at)
                                    <div class="col-md-3">
                                        <div class="card border-warning mb-3" style="max-width: 18rem;" id="cajaRep{{ $reporte->id }}">
                                            <div class="card-header" onclick="">{{ $reporte->created_at ?? 'sin registro de fecha' }}</div>
                                            <img src="..." class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $reporte->asunto }}</h5>
                                                <p class="card-text"> {{ $reporte->alumno->persona->nombre }} {{ $reporte->alumno->persona->apellido_p }} {{ $reporte->alumno->persona->apellido_m ?? '' }} - {{ $reporte->alumno->grupo->nombre ?? '(sin grupo)' }}</p>
                                                <a href="/trabajador/reportes/simple/{{ $reporte->id }}" class="btn btn-primary" onclick="ocultarReporte('cajaRep{{ $reporte->id }}')">Guardar</a>
                                                <a href="{{ route('trabajador.reportes.actualizar', ['reporte_id' => $reporte->id, 'trabajador_id' => $trabajador->id]) }}" class="btn btn-warning">Editar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                            <div id="info">
                                <br>
                                <div>
                                    <div class="alert alert-success" role="alert">
                                        En esta sección aparecerán los reportes pendientes, Por el momento  no tiene ningún reporte pendiente!
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div>
                            <div>
                                <a href="#" class="btn btn-primary">|</a>
                                <a href="/trabajador/reportes/{{ $trabajador->id }}" class="btn btn-primary">ver todos mis reportes</a><br>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        {{-- ------------------------------FOOTER --}}
        <div class="card-footer">
            
        </div>
    </div>



@stop

@section('estilos')
    <style>
        .errores{
            text-align: center;
            color: brown;
        }
        .btn{
            margin-inline: 10px;
        }
    </style>
    {{-- añadimos Select2 a partir de esta vista, --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('jscript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

        });
    </script>
    <script>
        //manejo de fechas en js
        function refrescar(){
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();
            document.getElementById('fecha').value=day+"/"+month+"/"+year;

        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop