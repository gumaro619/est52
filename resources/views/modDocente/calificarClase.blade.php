@extends('adminlte::page')

@section('title', 'Credencial-Alumnado')

@section('content_header')
    <p class="fs-1">ASIGNACIÓN DE CALIFICACIONES POR CLASE_</p>
    <a href="/docente" class="btn btn-primary"> Regresar al Panel principal de Docentes</a>
@stop

@section('content')
    <p class="fs-4">Calificará a toda la clase  para el periodo seleccionado
        Asegúrese de  ingresar la información inicial de forma correcta</p>

    <div @if($periodo!=='0')
            style="background-color: rgb(182, 182, 182)"
        @else
            style="background-color: rgb(206, 228, 228)"
        @endif>
        <form action="{{ route('docente.calificaciones.periodo') }}" method="POST" >
            @csrf
            <p class="fs-3">INFORMACIÓN INICIAL</p>
            <input type="hidden" class="form-control" id="clase_id_inf" name="clase_id_inf" value="{{ $clase->id ?? '-1' }}">
            <input type="hidden" id="clase_periodo_inf" name="clase_periodo_inf">
            <div id="infoInicial" class="row g-3">
                <div class="col-md-2">
                    <label for="inputCity" class="form-label">clase:</label>
                    <input type="text" class="form-control" id="f1clase" name="f1clase" value="{{ old('f1clase',$clase->grupo->nombre."  " .$clase->materia->nombre) }}" disabled>
                </div>
                <div class="col-md-2">
                    <label for="inputCity" class="form-label">Horario:</label>
                    <input type="text" class="form-control" id="f1horario" name="f1horario" value="{{ old('f1horario',substr($clase->horaE, 0, 5)."  -  ".substr($clase->horaS, 0, 5)) }}" disabled>
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
                    <select id="selectPeriodo" class="form-select" name="selectPeriodo" onclick="setPeriodo()" @if($periodo!=='0')
                        disabled
                    @endif>
                        <option value="1">Pimer periodo</option>
                        
                        <option value="2" @if($periodo=='2')
                            selected
                        @endif>Segundo periodo</option>

                        <option value="3" @if($periodo=='3')
                            selected
                        @endif>Tercer periodo</option>
                        
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">ciclo escolar:</label>
                    <input type="text" class="form-control" id="inputZip" value="{{ $clase->grupo->ciclo }}" disabled>
                </div>
                
            </div>
            <br>

            <div class="d-flex justify-content-rigth">
                <button type="submit" class="btn btn-success" @if($periodo!=='0')
                    style="display: none"
                @endif >Confirmar información inicial</button>

                <a href="/docente/calificaciones" class="btn btn-warning" role="button" >Seleccionar otra calse</a>

                <a href="/docente/calificaciones/{{ $clase->id }}" class="btn btn-info" role="button"  @if($periodo==0)
                    style="display: none"
                @endif>Seleccionar otro periodo</a>
                    
                <a href="/docente/calificaciones/general/{{ $clase->id }}" class="btn btn-primary" role="button" @if($periodo!=='0')
                    style="display: none"
                @endif >Visión general del {{ $clase->grupo->nombre }}</a>
            </div>
        </form>
        
    </div>

    <br>
    <section id="central" @if($periodo==0)
        style="display: none"
    @endif>
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
                            <th scope="col">Status</th>
                            <th scope="col">Grupo</th>
                            
                            <th scope="col">Calificación(p{{ $periodo }})</th>
                            <th scope="col">Faltas(p{{ $periodo }})</th>
                            <th scope="col">Examen Reg</th>
                            <th scope="col">Estado del registro:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clase->grupo->alumnos as $alumno)
                            <tr>
                                <td>{{ $loop->index+1}}
                                    <small>{{ $alumno->id }}</small>
                                    <input type="hidden" name="alumno_id[{{ $alumno->id }}]" value="{{ $alumno->id }}">
                                </td>
                                <td>{{ $alumno->persona->nombre ?? 'null'}}</td>
                                <td>{{ $alumno->persona->apellido_p ?? 'null'." ". $alumno->persona->apellido_m ?? 'null'}}</td>
        
                                <td>{{ $alumno->status}}</td>
                                <td>{{ $alumno->grupo->nombre ?? 'No asignado'}}</td>
            
                                <td>
                                    <div>
                                        <input type="text" maxlength="4" class="form-control" name="calificacion[{{ $alumno->id }}]" id="1" 
                                        style="text-align:center;" onkeypress="return esFloat(event)"  
                                        value="{{$cal = $alumno->calificaciones->where('periodo',$periodo)->where('clase_id',$clase->id)->first()->calificacion ?? ''  }}"
                                        placeholder="sin calificar">
                                    </div>
                                </td>
                                <td>
                                    <div >
                                        <input type="text" maxlength="2" class="form-control" name="faltas[{{ $alumno->id }}]" id="faltas[{{ $alumno->id }}]" 
                                        style="text-align:center;" oninput="validarNum('faltas[{{ $alumno->id }}]')" 
                                        value="{{$faltas = $alumno->calificaciones->where('periodo',$periodo)->where('clase_id',$clase->id)->first()->faltas ?? ''  }}"
                                        placeholder="sin calificar" onchange="validarDatos({{ $alumno->id }})">
                                        
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" value="{{$ex= $alumno->calificaciones->where('periodo',$periodo)->where('clase_id',$clase->id)->first()->examenR ?? 's/c' }}">
                                    <div>
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" id="no-{{ $alumno->id }}" name="hizoExamen[{{ $alumno->id }}]" value="no" 
                                            @if(old('hizoExamen[{{ $alumno->id }}]')==null)
                                                checked
                                            @endif>
                                            <label class="btn btn-outline-primary" for="no-{{ $alumno->id }}" >No</label>
                                
                                            <input type="radio" class="btn-check" id="si-{{ $alumno->id }}" name="hizoExamen[{{ $alumno->id }}]" value="si" 
                                            @if( $ex =='si')
                                                checked
                                            @endif
                                            >
                                            <label class="btn btn-outline-primary" for="si-{{ $alumno->id }}">Si</label>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        <label class="mycheckbox">
                                            <input type="checkbox" name="boxes[{{ $alumno->id }}]" id="boxes[{{ $alumno->id }}]" @if ($ex!=='s/c'&& $cal!==''&&$faltas!=='')
                                                checked
                                            @endif disabled>
                                            <span>
                                                <i class="fas fa-check on"></i>
                                                <i class="fas fa-times off"></i>
                                            </span>
                                        </label>
                                    </div>
                                    @if($ex!=='s/c'&& $cal!==''&&$faltas!=='')
                                        <p class="fs-7">Calificado: {{ $alumno->calificaciones->where('periodo',$periodo)->where('clase_id',$clase->id)->first()->updated_at ?? '?' }}</p>
                                    @else
                                        <p class="fs-7">Sin calificar</p>
                                    @endif
                                    
                                </td>
                            </tr>
                            @empty
                            <p>Parece que no tiene alumnos registrados en esta calse o no ha seleccionado el período</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <button type="submit" class="btn btn-primary" tabindex="4">Guardar Calificaciones</button>
            <a href="/docente/calificaciones" class="btn btn-secondary" role="button" >Cancelar</a>
        </form>

    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .mycheckbox input:checked ~ span::after{
            background: rgb(12, 167, 12);
            transform: scale(0.85) translate(35px);
        }
        .mycheckbox input:checked ~ span .on{
            transform: translate(30px);
            opacity: 1;
        }

        .mycheckbox input:checked ~ span .off{
            transform: translate(30px);
            opacity: 0;
        }

            .mycheckbox input:checked ~ span .on-bell{
            transform: translate(31px);
        }

            .mycheckbox input {
            display: none;
        }

        .mycheckbox span {
            display: inline-block;
            width: 60px;
            height: 30px;
            border-radius: 30px;
            background: rgb(187, 186, 186);
            cursor: pointer;
            box-shadow: inset 0px 0px 2px rgb(15, 15, 15);

            position: relative;
        }

        .mycheckbox span::after {
            content: "";
            display: block;
            width: 30px;
            height: 30px;
            transform: scale(0.85);
            border-radius: 30px;
            background: rgb(248, 22, 22);
            transition: 0.5s;
            box-shadow: inset 0px 0px 2px rgb(37, 37, 37);
        }

        .mycheckbox i {
            position: absolute;
            left: 7px;
            top: 7px;
            z-index: 1;
            color: white;
            transition: 0.5s;
        }

        .mycheckbox .on {
            opacity: 0;
            left: 7px;
            top: 7px;
        }

        .mycheckbox .off {
            left: 9px;
            top: 7px;
        }

        .mycheckbox .off-bell {
            left: 5px;
        }
    </style>

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