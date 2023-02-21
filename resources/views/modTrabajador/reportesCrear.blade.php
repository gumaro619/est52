@extends('modTrabajador.plantillaNoSlidebar')

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
    <div class="card card-danger">
        {{-- ------------------------------HEADER --}}
        <div class="card-header">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <h3 class="card-title fw-bold">FORMULARIO COMPLETO DE REPORTES</h3>
                    </div>
                </div>  
            </div>
        </div>

        {{-- ------------------------------BODY --}}
        <div class="card-body">
            <form action="{{ route('trabajador.reportes.completo.store') }}" method="POST">
                @csrf
        
                <!--  datos ocultos  -->
                <input type="hidden" class="form-control" name="trabajador_id" id="trabajador_id" value="{{ $trabajador->id }}" >
                <div class="alert alert-warning" role="alert">
                    El formulario completo también le permite elegir a múltiples alumnos
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-md-6" style="background-color: rgb(255, 231, 224)">
                        <div class="d-flex justify-content-center">
                            <select class="js-example-basic-multiple form-select form-select-lg mb-3" aria-label=".form-select-lg example" multiple="multiple" name="idAlumnos[]" tabindex="1" autofocus> 
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
                        <input type="text" class="form-control" name="asunto" id="asunto" value="{{ old('asunto','PENDIENTE') }}" placeholder="Indique el asunto del reporte" tabindex="2">
                        @error('asunto')
                            <p class="errores">*{{ $message }}</p>
                            <br>
                        @enderror
                    </div>  
                    <div class="col-md-6">
                        <label for="" class="form-label">Fecha (hoy): </label>
                        <input type="hidden" name="date" id="date" value="{{ now() }}">
                        <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha',now()->toDateString()) }}" >
                        @error('fecha')
                            <p class="errores">*{{ $message }}</p>
                            <br>
                        @enderror
                    </div>        
                </div>
                <br>
        
                <div id="cajaExtras">
                    <div class="mb-3">
                        <label for="" class="form-label">Puntaje: </label>
                        <div class="row g-3">
                            <div class="col-md-1">
                                <small>Sugerencias:</small>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <button type="button" class="btn btn-outline-success" onclick="setPuntos(0)">0 puntos</button>
                                    <label class="form-check-label" for="radio1Punto"> (penalización baja o llamado de atención)</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <button type="button" class="btn btn-outline-danger" onclick="setPuntos(1)">1 puntos</button>
                                    <label class="form-check-label" for="radio3Puntos"> (penalización media o reincidencias)</label>
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
                                    <button type="button" class="btn btn-outline-danger" onclick="setPuntos(3)">3 puntos</button>
                                    <label class="form-check-label" for="radio5Puuntos"> (falta grave)</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <button type="button" class="btn btn-outline-danger" onclick="setPuntos(5)">5 puntos</button>
                                    <label class="form-check-label" for="radio5Puuntos"> <b>(Queda en expediente)</b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="puntaje" id="puntaje" pattern="[0-9]*" inputmode="numeric" oninput="if(!this.value.match(/^\d*$/)){this.value=''}" value="{{ old('puntaje','0') }}">
                        </div>
                    </div>
                    @error('puntaje')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
        
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Descripción del reporte:</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Descripción detallada del reporte" tabindex="4">{{ old('observaciones') }}</textarea>
                        @error('observaciones')
                            <small class="errores">*{{ $message }}</small>
                            <br>
                        @enderror

                    </div>
                </div>
                <br>
                <div id="btns" class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger btn-lg" tabindex="5">Generar reporte(s)</button>
                </div>
                <br>
            </form>
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
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('jscript')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            document.getElementById("cajaBotonesHead").style.display = 'none';
            document.getElementById("titulo").textContent = "Crear reporte";

        });
    </script>
    <script>
        function refrescar(){
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();
            document.getElementById('fecha').value=day+"/"+month+"/"+year;

        }
        function setPuntos($puntos){
            document.getElementById('puntaje').value=$puntos;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        function validarNum(id){
            var valoresAceptados = /^[0-9]+$/,
                entrada=document.getElementById(id).value;

                if (entrada.match(valoresAceptados)){
                    setNum();
                    setFocus(id+1);
                } else {
                    document.getElementById(id).value="";
            }
        }

        function setNum(){
            var numero='';
            var i = 1;
            while (i <= 10) 
            {
            numero+=document.getElementById(i).value;
            i++;
            }
            document.getElementById('telefono_1').value=numero;
        }

        function setFocus(id){
            
            if(id==21){
                document.getElementById('correo').focus();
            }else{
                document.getElementById(id).focus();
            }
        }
        
    </script>
@stop