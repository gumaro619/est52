@extends('adminlte::page')

@section('title', 'Credencial-Alumnado')

@section('content_header')
    <p class="fs-1">VISIÓN GENERAL DE CALIFICACIONES POR GRUPO</p>
    <a href="/docente" class="btn btn-primary"> Regresar al Panel principal de Docentes</a>
@stop

@section('content')
    <p class="fs-4">Visión general de calificaciones </p>
    <div class="alert alert-info" role="alert">
        Atención no puede editar  desde la visión general
    </div>      
    <div style="background-color: rgb(177, 177, 177)">
        <p class="fs-3">INFORMACIÓN INICIAL</p>
        <div id="infoInicial" class="row g-3">
            <div class="col-md-2">
                <label for="inputCity" class="form-label">clase:</label>
                <input type="text" class="form-control" id="inputCity" value="{{ $clase->grupo->nombre."  " .$clase->materia->nombre }}" disabled>
            </div>
            <div class="col-md-2">
                <label for="inputCity" class="form-label">Horario:</label>
                <input type="text" class="form-control" id="inputCity" value="{{ substr($clase->horaE,0,5)." a ".substr($clase->horaS,0,5) }}" disabled>
            </div>
            <div class="col-md-3 d-flex justify-content-center" style="padding: 1em;">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" class="btn-check" id="L" disabled @if(str_contains($clase->dias, "L"))
                        checked
                    @endif>
                    <label class="btn btn-outline-primary" for="L">Lu</label>
        
                    <input type="checkbox" class="btn-check" id="M" disabled @if(str_contains($clase->dias, "M"))
                        checked
                    @endif>
                    <label class="btn btn-outline-primary" for="M">Ma</label>
        
                    <input type="checkbox" class="btn-check" id="W" disabled @if(str_contains($clase->dias, "W"))
                        checked
                    @endif>
                    <label class="btn btn-outline-primary" for="W">Mi</label>
        
                    <input type="checkbox" class="btn-check" id="J" disabled @if(str_contains($clase->dias, "J"))
                        checked
                    @endif>
                    <label class="btn btn-outline-primary" for="J">Ju</label>
        
                    <input type="checkbox" class="btn-check" id="V" disabled @if(str_contains($clase->dias, "V"))
                        checked
                    @endif>
                    <label class="btn btn-outline-primary" for="V">Vi</label>
                </div>
            </div>
            <div class="col-md-3">
                <label for="selectPeriodo" class="form-label">Período de calificación</label>
                <select id="selectPeriodo" class="form-select" name="selectPeriodo" onclick="setPeriodo()" disabled>
                    <option value="1">Visión general</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">ciclo escolar:</label>
                <input type="text" class="form-control" id="inputZip" value="{{ $clase->grupo->ciclo }}" disabled>
            </div>
            
        </div>
        <a href="/docente/calificaciones" class="btn btn-warning" role="button" >Seleccionar otra calse</a>
        <a href="/docente/calificaciones/{{ $clase->id }}" class="btn btn-success" role="button" >Editar calificaciones por periodo</a>   
    </div>

    
    <br>
        <section id="central">
        <form action="{{ route('docente.calificaciones.store') }}" method="POST" >
            @csrf

            <input type="hidden" name="periodo" id="periodo" value="" >
            <input type="hidden" name="clase_id" id="clase_id" value="{{ $clase->id }}">
            
            <div id="cajaCalificaciones">
                <table id="tablaAlumnos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Cal. (I)</th>
                            <th scope="col">F (I)</th>
                            <th scope="col">Ex R. I</th>
                            <th scope="col">Cal. (II)</th>
                            <th scope="col">F (II)</th>
                            <th scope="col">Ex R. II</th>
                            <th scope="col">Cal. ()III</th>
                            <th scope="col">F ()III</th>
                            <th scope="col">Ex R. III</th>

                            <th scope="col">Final</th>
                            <th scope="col">Faltas</th>
                            <th scope="col">Ex R.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clase->grupo->alumnos as $alumno)
                            @php
                                $exf=0;
                            @endphp
                            <tr>
                                <td>{{ $alumno->id}}
                                    <small type="texte" name="alumno_id[{{ $alumno->id }}]" value="{{ $alumno->id }}">
                                </td>
                                <td>{{ $alumno->persona->nombre ?? 'null'}}</td>
                                <td>{{ $alumno->persona->apellido_p ?? 'null'}}    {{ $alumno->persona->apellido_m ?? 'null'}}</td>

<!----------------------------------------------------------------- PERIODO 1 -->

                                <td class="cal1" style="background-color: rgb(233, 255, 236)">
                                    <div>
                                        <input type="text" maxlength="4" class="form-control" name="calificacion[{{ $alumno->id }}]" id="1" onkeypress="return esFloat(event)"
                                        style="text-align:center;"  required 
                                        value="{{ $cal1 = $alumno->calificaciones->where('periodo',1)->where('clase_id',$clase->id)->first()->calificacion ?? 's/c' }}">
                                    </div>
                                </td>
                                <td class="cal1" style="background-color: rgb(233, 255, 236)">
                                    <div>
                                        <input type="text" maxlength="2" class="form-control" name="faltas[{{ $alumno->id }}]" id="faltas[{{ $alumno->id }}]" 
                                        style="text-align:center;" oninput="validarNum('faltas[{{ $alumno->id }}]')" 
                                        value="{{ $faltas1 = $alumno->calificaciones->where('periodo',1)->where('clase_id',$clase->id)->first()->faltas ?? 's/c' }}"
                                        required>
                                    </div>
                                </td>
                                <td class="cal1" style="background-color: rgb(233, 255, 236)">
                                    <div>
                                        <input type="hidden" maxlength="2" class="form-control" name="examen[{{ $alumno->id }}]" id="examen[{{ $alumno->id }}]" 
                                        style="text-align:center;" oninput="validarNum('examen[{{ $alumno->id }}]')" required
                                        value="{{$ex1 = $alumno->calificaciones->where('periodo',1)->where('clase_id',$clase->id)->first()->examenR ?? 's/c' }}">
                                    </div>
                                    <div>
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" id="ex1si{{ $alumno->id }}" name="hizoExamen1[{{ $alumno->id }}]" value="no" 
                                            @if(old('hizoExamen1[{{ $alumno->id }}]')==null)
                                                checked
                                            @endif>
                                            <label class="btn btn-outline-primary" for="ex1si{{ $alumno->id }}" >No</label>
                                
                                            <input type="radio" class="btn-check" id="ex1no{{ $alumno->id }}" name="hizoExamen1[{{ $alumno->id }}]" value="si" 
                                            @if( $ex1 =='si')
                                                checked
                                            @endif>
                                            <label class="btn btn-outline-primary" for="ex1no{{ $alumno->id }}">Si</label>
                                        </div>
                                    </div>
                                </td>

<!----------------------------------------------------------------- PERIODO 2 -->

                                
                                
                                <td class="cal2" style="background-color: rgb(255, 206, 255)">
                                    <div class="errores">
                                        <input type="text" maxlength="4" class="form-control" name="calificacion2[{{ $alumno->id }}]" id="1" onkeypress="return esFloat(event)"
                                        style="text-align:center;"  required 
                                        value="{{$cal2 = $alumno->calificaciones->where('periodo',2)->where('clase_id',$clase->id)->first()->calificacion ?? 's/c' }}">
                                    </div>
                                </td>
                                <td class="cal2" style="background-color: rgb(255, 206, 255)">
                                    <div class="errores">
                                        <input type="text" maxlength="2" class="form-control" name="faltas2[{{ $alumno->id }}]" id="faltas2[{{ $alumno->id }}]" 
                                        style="text-align:center;" oninput="validarNum('faltas2[{{ $alumno->id }}]')" 
                                        value="{{$faltas2 = $alumno->calificaciones->where('periodo',2)->where('clase_id',$clase->id)->first()->faltas ?? 's/c' }}"
                                        required>
                                    </div>
                                </td>
                                <td class="cal2" style="background-color: rgb(255, 206, 255)">
                                    <div class="errores">
                                        <input type="hidden" maxlength="2" class="form-control" name="examen2[{{ $alumno->id }}]" id="examen2[{{ $alumno->id }}]" 
                                        style="text-align:center;" oninput="validarNum('examen2[{{ $alumno->id }}]')" required
                                        value="{{$ex2 = $alumno->calificaciones->where('periodo',2)->where('clase_id',$clase->id)->first()->examenR ?? 's/c' }}">
                                    </div>
                                    <div>
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" id="ex2si{{ $alumno->id }}" name="hizoExamen2[{{ $alumno->id }}]" value="no" 
                                            @if(old('hizoExamen2[{{ $alumno->id }}]')==null)
                                                checked
                                            @endif>
                                            <label class="btn btn-outline-primary" for="ex2si{{ $alumno->id }}" >No</label>
                                
                                            <input type="radio" class="btn-check" id="ex2no{{ $alumno->id }}" name="hizoExamen2[{{ $alumno->id }}]" value="si" 
                                            @if( $ex2 =='si')
                                                checked
                                            @endif>
                                            <label class="btn btn-outline-primary" for="ex2no{{ $alumno->id }}">Si</label>
                                        </div>
                                    </div>
                                </td>

<!----------------------------------------------------------------- PERIODO 3 -->


                                <td class="cal3" style="background-color: rgb(210, 233, 255)">
                                    <div>
                                        <input type="text" maxlength="4" class="form-control" name="calificacion3[{{ $alumno->id }}]" id="3" onkeypress="return esFloat(event)"
                                        style="text-align:center;"  required 
                                        value="{{$cal3 = $alumno->calificaciones->where('periodo',3)->where('clase_id',$clase->id)->first()->calificacion ?? 's/c' }}">
                                    </div>
                                </td>
                                <td class="cal3" style="background-color: rgb(210, 233, 255)">
                                    <div>
                                        <input type="text" maxlength="2" class="form-control" name="faltas3[{{ $alumno->id }}]" id="faltas3[{{ $alumno->id }}]" 
                                        style="text-align:center;" oninput="validarNum('faltas3[{{ $alumno->id }}]')" 
                                        value="{{$faltas3 = $alumno->calificaciones->where('periodo',3)->where('clase_id',$clase->id)->first()->faltas ?? 's/c' }}"
                                        required>
                                    </div>
                                </td>
                                <td class="cal3" style="background-color: rgb(210, 233, 255)">
                                    <div>
                                        <input type="hidden" maxlength="2" class="form-control" name="examen3[{{ $alumno->id }}]" id="examen3[{{ $alumno->id }}]" 
                                        style="text-align:center;" oninput="validarNum('examen3[{{ $alumno->id }}]')" required
                                        value="{{$ex = $alumno->calificaciones->where('periodo',3)->where('clase_id',$clase->id)->first()->examenR ?? 's/c' }}">
                                    </div>
                                    <div>
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" id="ex3si{{ $alumno->id }}" name="hizoExamen3[{{ $alumno->id }}]" value="no" 
                                            @if(old('hizoExamen3[{{ $alumno->id }}]')==null)
                                                checked
                                            @endif>
                                            <label class="btn btn-outline-primary" for="ex3si{{ $alumno->id }}" >No</label>
                                
                                            <input type="radio" class="btn-check" id="ex3no{{ $alumno->id }}" name="hizoExamen3[{{ $alumno->id }}]" value="si" 
                                            @if( $ex =='si')
                                                checked
                                            @endif>
                                            <label class="btn btn-outline-primary" for="ex3no{{ $alumno->id }}">Si</label>
                                        </div>
                                    </div>
                                </td>

<!----------------------------------------------------------------- finales  -->


                                @php
                                    try {
                                        $calf = ($cal1+$cal2+$cal3)/3;
                                        $faltasf=$faltas1+$faltas2+$faltas3;
                                    } catch (Throwable $e) {
                                        $calf ='-';
                                        $faltasf='-';
                                    }
                                @endphp

                                <td style="background-color: rgb(194, 194, 194)">
                                    <div>
                                        <input type="text" maxlength="4" class="form-control" name="calificacion4[{{ $alumno->id }}]" id="4" 
                                        style="text-align:center;" readonly value="{{ $calf }}">
                                    </div>
                                </td>
                                <td style="background-color: rgb(194, 194, 194)">
                                    <div>
                                        <input type="text" maxlength="2" class="form-control" name="faltas3[{{ $alumno->id }}]" id="faltas3[{{ $alumno->id }}]" 
                                        style="text-align:center;" value="{{ $faltasf}}"
                                        readonly>
                                    </div>
                                </td>
                                <td style="background-color: rgb(194, 194, 194)">
                                    @php
                                        if($ex1 =='si')
                                            $exf+=1;
                                        if($ex2 =='si')
                                            $exf+=1;
                                        if($ex =='si')
                                            $exf+=1;
                                    @endphp
                                    <div>
                                        <input type="text" maxlength="2" class="form-control" name="examen3[{{ $alumno->id }}]" id="examen3[{{ $alumno->id }}]" 
                                        style="text-align:center;" value="{{ $exf }}"
                                        readonly>
                                    </div>
                                </td>





                                <td>
                                    <p>sin calificar</p>
                                </td>
                            </tr>
                            @empty
                            <p>Parece que no tiene alumnos registrados en esta calse o no ha seleccionado el período</p>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="display: none">
                <a href="/docente/calificaciones" class="btn btn-secondary" role="button" >Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Guardar Calificaciones</button>
            </div>

        </form>

</section>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#tablaAlumnos').DataTable();
                setPeriodo();
            });
            $('#tablaAlumnos').DataTable( {
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
        function setPeriodo(){
            var periodo=document.getElementById('selectPeriodo').value;
            document.getElementById('periodo').value=periodo;
            document.getElementById('clase_periodo_inf').value=periodo;
        }
        function esFloat(evt)
        {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 
                && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
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
    </script>
@stop