@extends('adminlte::page')

@section('title', 'Multi-Reportes')
    
@section('content_header')
    @include('modWidgets.mostrarHeader', ['trabajador' => $trabajador])
    
    <div class="row g-3">
        <div class="d-flex justify-content-center">
            <a href="/trabajador/{{ $trabajador->id }}" class="btn btn-warning">Regresar a la sección principal</a><br>
            <div class="m-1"></div>
            <a href="/trabajador/reportes/{{ $trabajador->id }}" class="btn btn-secondary">Cancelar actualización</a><br>
        </div>
    </div>
@stop

@section('content')

    @include('modWidgets.infoReporteEditView', ['reporte' => $reporte])
    <hr>
    <div class="card card-warning">
        {{-- ------------------------------HEADER --}}
        <div class="card-header">
            <div class="d-flex justify-content-center">
                <h3 class="card-title"><b>FORMULARIO DE EDICIÓN DE REPORTES</b></h3>
            </div>
        </div>
    
        {{-- ------------------------------BODY --}}
        <div class="card-body">
            <form action="{{ route('trabajador.reportes.completo.update') }}" method="POST" id="formReporte">
                @csrf
        
                <!--  datos ocultos  -->
                <input type="hidden" class="form-control" name="trabajador_id" id="trabajador_id" value="{{ $trabajador->id }}" >
                <input type="hidden" name="alumno_id" id="alumno_id" value="{{ $reporte->alumno->id }}">
                <input type="hidden" name="reporte_id" id="reporte_id" value="{{ $reporte->id }}">
        
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="" class="form-label">Estudiante : </label>
                        <input type="text" disabled class="form-control" value="{{ $reporte->alumno->persona->nombre }} {{ $reporte->alumno->persona->apellido_p }} {{ $reporte->alumno->persona->apellido_m ?? '' }} - {{ $reporte->alumno->grupo->nombre ?? '(sin grupo)' }}" readonly>        
                    </div> 
                    <div class="col-md-4">
                        <label for="" class="form-label">Asunto : </label>
                        <input type="text" class="form-control" name="asunto" id="asunto" value="{{ old('asunto',$reporte->asunto ?? 'sin asunto') }}" placeholder="Indique el asunto del reporte" disabled>
                        @error('asunto')
                            <p class="errores">*{{ $message }}</p>
                            <br>
                        @enderror
                    </div>  
                    <div class="col-md-4">
                        <label for="" class="form-label">Fecha : </label>
                        <input type="hidden" name="date" id="date" value="{{ now() }}">
                        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha',$reporte->fecha) }}" disabled>
                        @error('fecha')
                            <p class="errores">*{{ $message }}</p>
                            <br>
                        @enderror
                    </div>        
                </div>
                <br>
        
                <div id="cajaExtras" >
                    <label for="" class="form-label">Puntaje: </label>
                    <div class="row g-3">
                        <div class="col-md-1">
                            <small>Sugerencias:</small>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <button type="button" class="btn btn-outline-success" onclick="setPuntos(0)" disabled id="bt0">0 puntos</button>
                                <label class="form-check-label" for="radio1Punto"> (penalización baja o llamado de atención)</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <button type="button" class="btn btn-outline-danger" onclick="setPuntos(1)" disabled id="bt1">1 puntos</button>
                                <label class="form-check-label" for="radio3Puntos"> (penalización media o reincidencias)</label>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-check form-check-inline">
                                <button type="button" class="btn btn-outline-danger" onclick="setPuntos(3)" disabled id="bt2">3 puntos</button>
                                <label class="form-check-label" for="radio5Puuntos"> (falta grave)</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <button type="button" class="btn btn-outline-danger" onclick="setPuntos(5)" disabled id="bt3">5 puntos</button>
                                <label class="form-check-label" for="radio5Puuntos"> <b>(Queda en expediente)</b></label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-4">
                            <input type="number" class="form-control" min="0" max="10"  name="puntaje" id="puntaje" value="{{ @old('puntaje',$reporte->puntaje) }}" tabindex="3" disabled>
                        </div>
                    </div>
                    @error('puntaje')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
        
                    <div class="mb-3">
                        <label for="" class="form-label">Descripción del reporte: </label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Descripción detallada del reporte" tabindex="4" disabled>{{ old('observaciones',$reporte->observaciones) }}</textarea>
                        @error('observaciones')
                            <small class="errores">*{{ $message }}</small>
                            <br>
                        @enderror
                    </div>
                </div>
                
        
                <div id="btns" class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg" tabindex="" name="btnActualizar" id="btnActualizar" disabled>Actualizar reporte</button>
                </div>
            </form>
        </div>
        {{-- ------------------------------FOOTER --}}
        <div class="card-footer">
        </div>
    </div>
@stop

@section('css')
    <style>
        .errores{
            text-align: center;
            color: brown;
        }
        #btnVer{
            border-color: rgb(242, 193, 16);
            box-shadow: 0 0 10px  #575757;
        }
        #btnEditar{
            background-color: rgb(225, 225, 225);
        }
        .btns {
            /* de entrada estamos en ver,  y por js desactivamos editar */
            border-color: rgb(209, 209, 209);
            box-shadow: 0 0 10px  #717171;
        }

        #btnEditar:hover {
            border-color: rgb(242, 193, 16);
            box-shadow: 0 0 10px  #bd883e;
            background-color: rgb(240, 240, 240);

        }
    </style>
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            // editar no permite el slidebar
            document.querySelector('.main-sidebar').style.display = 'none';
            document.querySelector('.main-header').style.marginLeft = '0';
            document.querySelector('.content-wrapper').style.marginLeft = '0';
            //reacomodamos el primer include 
            document.getElementById("titulo").textContent = "Actualizar reporte";
            //ocultamos los botonoes del head fragmento(pensado para alumnos)
            document.getElementById("cajaBotonesHead").style.display = 'none';


            //buscamos el noton para edtar
            var btnEditar = document.getElementById("btnEditar");
            // Agregar un listener de evento click al div
            btnEditar.addEventListener("click", function() {
                //ponemos el listener
                document.getElementById('asunto').disabled=false;
                document.getElementById('fecha').disabled=false;
                document.getElementById('observaciones').disabled=false;
                document.getElementById('puntaje').disabled=false;
                document.getElementById('btnActualizar').disabled=false;
                document.getElementById('bt0').disabled=false;
                document.getElementById('bt1').disabled=false;
                document.getElementById('bt2').disabled=false;
                document.getElementById('bt3').disabled=false;

                document.getElementById("btnEditar").style.backgroundColor = "white";
                document.getElementById("btnVer").style.border = "none";
                document.getElementById("btnVer").style.backgroundColor = "rgb(225, 225, 225)";
            });

        });

        

        $('#formReporte').submit(function (evt) {
                evt.preventDefault(); 
                
                Swal.fire({
                title: '¿Desea actualizar el reporte?',
                text: "Se actualizaran los datos del reporte",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí, actualizar reporte'
                }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire(
                    'actualizado!',  
                    'el reporte bha sido actualizado',
                    'success'
)
                }
                })
            });


    </script>
    <script>
        function editar(){

        }
        function setPuntos($puntos){
            document.getElementById('puntaje').value=$puntos;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop