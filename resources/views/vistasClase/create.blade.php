@extends('adminlte::page')

@section('title', 'CREATE_CLASE')

@section('content_header')

<h1>CREAR NUEVA CLASE</h1>

@stop


@section('content')
    <!-- un submit activa automaticamnte  el metodo store() en el controlador que invoca, NO SE LLAMA-->
    <form action="/clases" method="POST" name="formClase">
        @csrf

        <br><div class="mb-3">
            <label for="" class="form-label">Materia: </label>
        </div>
        <table id="tablaMaterias" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">PROGRAMA</th>
                    <th scope="col">Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materias as $materia)
                    <tr>
                        <td>{{ $materia->id}}</td>
                        <td>{{ $materia->nombre}}</td>
                        <td>{{ $materia->programa}}</td>
                        <td>
                            <div class="form-check">
                                <input type="radio" class="btn-check" id="{{ $materia->id }}m" name="materia_id" value="{{ $materia->id }}" 
                                    {{ old('materia_id') == $materia->id ? 'checked' : '' }} >
                                <label class="form-check-label" for="{{ $materia->id }}m"><--</label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p>NO HAY REGISTRO DE MATERIAS</p>
                    <small class="errors"> ES OBLIGATORIO PARA CREAR UNA CLASE</small>
                @endforelse
            </tbody>
        </table>  
        @error('materia_id')
            <P class="errores">*{{ $message }}</P>
            <br>
        @enderror
        <br>

<!-- --------------------------------------------------------------------- -->

        <div class="mb-3">
            <label for="" class="form-label">Hora de la clase (Módulos actuales de 50 minutos): </label><br>
            <P>Favor de utilizazr un formato de 24 hrs</P>
        </div>

        <div class="form-check form-check-inline">
            <small>Sugerencias:</small>
        </div>
        <div >
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-success" onclick="setHoraIF('07:00','07:50')">07:00-07:50</button>
            </div>
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-secondary" onclick="setHoraIF('07:50','08:40')">07:50-08:40</button>
            </div>

            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-warning" onclick="setHoraIF('08:40','09:30')">08:40-09:30</button>
            </div>

            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-outline-secondary">Receso 09:30-10:00</button>
            </div>

            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-success" onclick="setHoraIF('10:00','10:50')">10:00-10:50</button>
            </div>
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-secondary" onclick="setHoraIF('10:50','11:40')">10:50-11:40</button>
            </div>
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-warning" onclick="setHoraIF('11:40','12:30')">11:40-12:30</button>
            </div>

            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-outline-secondary">Receso 12:30-12:40</button>
            </div>

            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-success" onclick="setHoraIF('12:40','13:30')">12:40-13:30</button>
            </div>
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-secondary" onclick="setHoraIF('13:30','14:20')">13:30-14:20</button>
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="col-2">
                <p class="text-center">detallar hora --></p>
                <p></p>
            </div>
            <div class="col-2">
                <p class="font-italic text-center">Hora inicial:</p>
            </div>
            <div class="col">
                <input type="time" class="form-control" id="horaI" name="horaI" value="{{ old('horaI') }}"  >
            </div>
            <div class="col-2">
                <p class="font-italic text-center">Hora final:</p>
            </div>
            <div class="col">
                <input type="time" class="form-control" id="horaF" name="horaF" value="{{ old('horaF') }}"  >
            </div>
        </div>
        @error('horaI')
            <P class="errores">*{{ $message }}</P>
            <br>
        @enderror
        @error('horaF')
            <P class="errores">*{{ $message }}</P>
            <br>
        @enderror



        <div class="mb-3">
            <label for="" class="form-label">Grupo: </label>
        </div>
        <table id="tablaGrupos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">GRUPO</th>
                    <th scope="col">CICLO ESCOLAR</th>
                    <th scope="col">Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->id}}</td>
                        <td>{{ $grupo->nombre}}</td>
                        <td>{{ $grupo->ciclo}}</td>
    
                        <td>
                            <div class="form-check">
                                <input type="radio" class="btn-check" id="{{ $grupo->id }}°" name="grupo_id" value="{{ $grupo->id }}" 
                                    {{ old('grupo_id') == $grupo->id ? 'checked' : '' }} >
                                <label class="form-check-label" for="{{ $grupo->id }}°"><--</label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p>NO HAY REGISTRO DE GRUPOS CREADOS</p>
                @endforelse
            </tbody>
        </table>  
        @error('grupo_id')
            <P class="errores">*{{ $message }}</P>
            <br>
        @enderror
        <br>
<!-- --------------------------------------------------------------------- -->

        <div class="mb-3">
            <label for="" class="form-label">Docente: </label>
            <div id="nombre" class="form-text">Seleccione el profesor encargado de esta clase</div>
        </div>
        <table id="tablaDocentes" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDOS</th>
                    <th scope="col">Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($docentes as $docente)
                    <tr>
                        <td>{{ $docente->id}}</td>
                        <td>{{ $docente->trabajador->persona->nombre}}</td>
                        <td>{{ $docente->trabajador->persona->apellido_p." ".$docente->trabajador->persona->apellido_m}}</td>
                        <td>
                            <div class="form-check">
                                <input type="radio" class="btn-check" id="{{ $docente->id }}d" name="docente_id" value="{{ $docente->id }}" 
                                    {{ old('docente_id') == $docente->id ? 'checked' : '' }} >
                                <label class="form-check-label" for="{{ $docente->id }}d"><--</label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p>NO HAY REGISTRO DE PROFESORES</p>
                @endforelse
            </tbody>
        </table>  
        @error('docente_id')
            <P class="errores">*{{ $message }}</P>
            <br>
        @enderror
        <br>

<!-- --------------------------------------------------------------------- -->

        <br>
        <div class="mb-3">
            <label for="" class="form-label">Días de la semana (L,M,W,J,V,S): </label>
        </div>

        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="L" id="Lunes" name="dias[]" 
            @if(is_array(old('dias')) && in_array('L',old('dias')))
                checked
            @endif onchange="setDias()" onclick="setNombre()">
            <label class="form-check-label" for="Lunes"> Lunes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="M" id="Martes" name="dias[]"
            @if(is_array(old('dias')) && in_array('M',old('dias')))
                checked
            @endif onchange="setDias()" onclick="setNombre()">
            <label class="form-check-label" for="Martes"> Martes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="W" id="Miercoles" name="dias[]"
            @if(is_array(old('dias')) && in_array('W',old('dias')))
                checked
            @endif onchange="setDias()" onclick="setNombre()">
            <label class="form-check-label" for="Miercoles"> Miercoles</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="J" id="Jueves" name="dias[]"
            @if(is_array(old('dias')) && in_array('J',old('dias')))
                checked
            @endif onchange="setDias()" onclick="setNombre()">
            <label class="form-check-label" for="Jueves"> Jueves</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="V" id="Viernes" name="dias[]"
            @if(is_array(old('dias')) && in_array('V',old('dias')))
                checked
            @endif onchange="setDias()" onclick="setNombre()">
            <label class="form-check-label" for="Viernes"> Viernes</label>
        </div>
        @error('dias[]')
            <P class="errores" style="display: block">*{{ $message }}</P>
            <br>
        @enderror
        <br>
<!-- --------------------------------------------------------------------- -->


        <div class="mb-3">
            <br>
            <label for="" class="form-label">Aula: </label>
            <small>(Opcional)</small>
            <div id="nombre" class="form-text">Seleccione un aula</div>
        </div>
        <table id="tablaAulas" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">COMENTARIOS ESCOLAR</th>
                    <th scope="col">Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aulas as $aula)
                    <tr>
                        <td>{{ $aula->id}}</td>
                        <td>{{ $aula->nombre}}</td>
                        <td>{{ $aula->comentarios}}</td>

                        <td>
                            <div class="form-check">
                                <input type="radio" class="btn-check" id="{{ $aula->id }}a" name="aula_id" value="{{ $aula->id }}" 
                                    {{ old('aula_id') == $aula->id ? 'checked' : '' }} >
                                <label class="form-check-label" for="{{ $aula->id }}a"><--</label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p>NO HAY REGISTRO DE AULAS</p>
                @endforelse
            </tbody>
        </table>  
        @error('aula_id')
            <P class="errores">*{{ $message }}</P>
            <br>
        @enderror
        <br>
<!-- --------------------------------------------------------------------- -->

        
        <a href="/clases" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
    </form>
@stop

<!-- --------------------------------------------------------------------- -->

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        .errores{
            color: rgb(196, 18, 18);
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaGrupos').DataTable();
            $('#tablaDocentes').DataTable();
            $('#tablaMaterias').DataTable();
            $('#tablaAulas').DataTable();
        });

        $('#tablaMaterias,#tablaDocentes,#tablaGrupos,#tablaAulas').DataTable( {
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
        function setHoraIF(horaI,horaF) {
            document.getElementById('horaF').value=horaF;
            document.getElementById('horaI').value=horaI;
        }
    </script>
@stop