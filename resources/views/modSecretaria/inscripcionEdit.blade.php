@extends('vistasPersona.formularioEditPersona')

@section('header')
    <h1>EDITAR INFORMACIÓN ESCOLAR DEL ESTUDIANTE</h1>
    <p>DATOS GENERALES DEL ALUMNO</p>
@endsection

@section('actionPOST')
    /inscripciones/{{ $persona->alumno->id}}
@endsection

@section('inputsFormulario')
    <p>DATOS DE CONTACTO PARA EMERGENCIAS</p>

    <div class="mb-3">
        <label for="" class="form-label">CURP: </label>
        <input type="text" class="form-control" name="curp" id="curp" value="{{ old('curp',$persona->alumno->curp) }}">
        @error('curp')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Status: </label>
        <div class="d-flex justify-content-center">
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-primary" onclick="setStatus('reinscripcion')">reinscripción</button>
            </div>
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-warning" onclick="setStatus('preinscripcion')">preinscripción</button>
            </div>
        </div>
        <input type="text" class="form-control" id="status" name="status" value="{{ old('status',$persona->alumno->status) }}" tabindex="7">
        @error('status')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>


    <div class="mb-3">
        <label for="" class="form-label">Fecha inscripcion/reinscripción: </label>
        <input type="date" class="form-control" id="fechaInscripcion" name="fechaInscripcion" value="{{ old('fechaInscripcion',$persona->alumno->fechaInscripcion) }}" tabindex="8">
        @error('fechaInscripcion')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Grado:  </label><br>
        <small>¿A qué grado va a inscribirse/reinscribirse el estudiante? pd. dato irrelevante una vez el alumno tenga asignado un grupo, es indispensable solo en el periodo de inscripciones</small>

        <div class="d-flex justify-content-center">
            <div class="form-check">
                <input type="radio" class="form-check-input" id="primero" name="grados" value="1" @checked('grados') onclick="setGrado(1)" tabindex="10">
                <label class="form-check-label" for="primero"> 1° Primero </label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="segundo" name="grados" value="2" {{ old('grados') == '2' ? 'checked' : '' }} onclick="setGrado(2)">
                <label class="form-check-label" for="segundo"> 2° Segundo </label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="tercero" name="grados" value="3" {{ old('grados') == '3' ? 'checked' : '' }} onclick="setGrado(3)">
                <label class="form-check-label" for="tercero"> 3° Tercero </label>
            </div>
        </div>
        <input type="text" class="form-control" id="grado" name="grado" value="{{  old('grado',$persona->alumno->grado) }}" tabindex="9" readonly>
        @error('grado')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>



    

    <div>
        <p style="text-align:center">DATOS DEL TUTOR</p>
        @if ($persona->alumno->tutor_id == null)
                <p>Este alumno no tiene asignado actualmente un Tutor, favor de rellenar el formulario a continuación</p>
                <p>Si el tutor  ya está registrado, puede seleccionarlo de la lista de tutores</p>
                <p>NUEVO TUTOR</p>
            @else
                <p>EDITAR INFORMAIÓN DEL TUTOR</p>
                <p>Si desea cambiar el tutor actual por otro ya registrado en el sistema (por ejemplo un padre de faminlia con más de 1 hijo(a) puede acceder a la lista </p>
        @endif
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" id="nuevoTutor" name="existeTutor" value="no" {{ old('existeTutor')=='si' ? '' : 'checked' }} onclick="ocultarTablas()" tabindex="10">
            <label class="btn btn-outline-primary" for="nuevoTutor" >Formulario del tutor</label>

            <input type="radio" class="btn-check" id="selectTutor" name="existeTutor" value="si" {{ old('existeTutor')== 'si' ? 'checked' : '' }} onclick="mostrarTablas()">
            <label class="btn btn-outline-primary" for="selectTutor">Lista de tutores</label>
        </div>
        <div class="form-check">
            
            <br>
            @error('existeTutor')
                <small class="errores">*{{ $message }}</small>
                <br>
            @enderror
        </div>
    </div>

    <div id="datosTutor">
        <section id="formularioTutor" class="cajas">
    
            <div class="mb-3">
                <label for="" class="form-label">Nombre: </label>
                <input type="text" class="form-control" name="nombreTutor" id="nombreTutor" value="{{ old('nombreTutor',$persona->alumno->tutor->persona->nombre ?? '') }}" tabindex="11">
                @error('nombreTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Apellido_p: </label>
                <input type="text" class="form-control" id="apellido_p" name="apellido_pTutor" value="{{ old('apellido_pTutor',$persona->alumno->tutor->persona->apellido_p ?? '') }}" tabindex="11">
                @error('apellido_pTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Apellido_m: </label>
                <input type="text" class="form-control" id="apellido_mTutor" name="apellido_mTutor" value="{{ old('apellido_mTutor',$persona->alumno->tutor->persona->apellido_m ?? '') }}" tabindex="11">
                @error('apellido_mTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <label class="form-label">Sexo: </label>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="masculinoTutor" name="sexoTutor" value="M" @if(old('sexoTutor')=='M')
                    checked
                @elseif(($persona->alumno->tutor->persona->sexo ?? '')=='M'&&old('sexo')==null)
                    checked
                @endif>
                <label class="form-check-label" for="masculinoTutor">Masculino</label>
            </div>
            <div class="form-check mb-3">
                <input type="radio" class="form-check-input" id="femeninoTutor" name="sexoTutor" value="F" @if(old('sexoTutor')=='F')
                    checked
                @elseif(($persona->alumno->tutor->persona->sexo ?? '')=='F'&&old('sexo')==null)
                    checked
                @endif>
                <label class="form-check-label" for="femeninoTutor">Femenino</label>
                @error('sexoTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Fecha de nacimiento: </label>
                <input type="date" class="form-control" id="fecha_nacimientoTutor" name="fecha_nacimientoTutor" value="{{ old('fecha_nacimientoTutor',$persona->alumno->tutor->persona->fecha_nacimiento ?? '') }}" tabindex="13">
                @error('fecha_nacimientoTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    

    
            <div class="mb-3">
                <label for="" class="form-label">Teléfono principal: </label><br><small>Actual->{{ $num =$persona->alumno->tutor->telefono_1 ?? 'sin registro' }}</small><br>
                <div class="d-flex justify-content-center"> 
                    <div class="col-md-8">
                        <div class="d-flex justify-content-center">
                            <small class="leyenda" >Asignar o actualizar el número principal del tutor (10 dígitos)</small>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-1">
                                <input type="text" maxlength="1" class="form-control" name="1" id="1" style="text-align:center;" oninput="validarNum(1)" tabindex="14" value="{{ old('1') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" maxlength="1" class="form-control" name="2" id="2" style="text-align:center;" oninput="validarNum(2)" value="{{ old('2') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" maxlength="1" class="form-control" name="3" id="3" style="text-align:center;" oninput="validarNum(3)" value="{{ old('3') }}">
                                <label for="" class="form-label"></label>
                            </div>
        
                            <div class="col-md-1">
                                <div class="d-flex justify-content-center">
                                    <p>---</p>
                                </div>
                            </div>
        
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="4" id="4" style="text-align:center;" oninput="validarNum(4)" value="{{ old('4') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="5" id="5" style="text-align:center;" oninput="validarNum(5)" value="{{ old('5') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="6" id="6" style="text-align:center;" oninput="validarNum(6)" value="{{ old('6') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="7" id="7" style="text-align:center;" oninput="validarNum(7)" value="{{ old('7') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="8" id="8" style="text-align:center;" oninput="validarNum(8)" value="{{ old('8') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="9" id="9" style="text-align:center;" oninput="validarNum(9)" value="{{ old('9') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="10" id="10" style="text-align:center;" oninput="validarNum(10)" value="{{ old('10') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <small>Nuevo-></small>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="telefono_1" id="telefono_1"  value="{{ old('telefono_1',$num) }}" readonly style="text-align: center;">
                    </div>
                </div>
                @error('telefono_1')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>

            
    
            <div class="mb-3">
                <label for="" class="form-label">Teléfono Secundario: </label><br><small>Actual->{{ $num2 =$persona->alumno->tutor->telefono_2 ?? 'sin registro' }}</small><br>
                <div class="d-flex justify-content-center"> 
                    <div class="col-md-8">
                        <div class="d-flex justify-content-center">
                            <small class="leyenda" >Asignar/actualizar  número secundario del tutor (10 dígitos)</small>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-1">
                                <input type="text" maxlength="1" class="form-control" name="11" id="11" style="text-align:center;" oninput="validarNum(11)" tabindex="15" value="{{ old('11') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" maxlength="1" class="form-control" name="12" id="12" style="text-align:center;" oninput="validarNum(12)" value="{{ old('12') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" maxlength="1" class="form-control" name="13" id="13" style="text-align:center;" oninput="validarNum(13)" value="{{ old('13') }}">
                                <label for="" class="form-label"></label>
                            </div>
    
                            <div class="col-md-1">
                                <div class="d-flex justify-content-center">
                                    <p>---</p>
                                </div>
                            </div>
        
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="14" id="14" style="text-align:center;" oninput="validarNum(14)"  value="{{ old('14') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="15" id="15" style="text-align:center;" oninput="validarNum(15)"  value="{{ old('15') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="16" id="16" style="text-align:center;" oninput="validarNum(16)"  value="{{ old('16') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="17" id="17" style="text-align:center;" oninput="validarNum(17)"  value="{{ old('17') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="18" id="18" style="text-align:center;" oninput="validarNum(18)"  value="{{ old('18') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="19" id="19" style="text-align:center;" oninput="validarNum(19)"  value="{{ old('19') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            <div class="col-md-1">
                                <input type="text" class="form-control" maxlength="1" name="20" id="20" style="text-align:center;" oninput="validarNum(20)"  value="{{ old('20') }}">
                                <label for="" class="form-label"></label>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <small>Nuevo-></small>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="telefono_2" name="telefono_2" value="{{ old('telefono_2',$num2) }}" readonly tabindex="-1" style="text-align: center;">
                    </div>
                </div>
                @error('telefono_2')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
    
            <div class="mb-3">
                <label for="" class="form-label">Correo electrónico: </label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo',$persona->alumno->tutor->correo ?? '') }}" tabindex="16">
                @error('correo')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Estado: </label>
                <input type="text" class="form-control" id="estado" name="estado"  value="{{ old('estado',$persona->alumno->tutor->estado ?? 'Oaxaca') }}" tabindex="17">
                @error('estado')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Municipio: </label>
                <input type="text" class="form-control" id="municipio" name="municipio" value="{{ old('municipio',$persona->alumno->tutor->municipio ?? 'Puerto Ángel') }}" tabindex="18">
                @error('municipio')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Colonia: </label>
                <input type="text" class="form-control" id="colonia" name="colonia" value="{{ old('colonia',$persona->alumno->tutor->colonia ?? '') }}" tabindex="19">
                @error('colonia')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Calle: </label>
                <input type="text" class="form-control" id="calle" name="calle" value="{{ old('calle',$persona->alumno->tutor->calle ?? '') }}" tabindex="20">
                @error('calle')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="" class="form-label">Número: </label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero',$persona->alumno->tutor->numero ?? '') }}" tabindex="21">
                @error('numero')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
        </section>
    </div>

    
    <div id="cajaTutorG">
        <div class="mb-3">
            <label for="" class="form-label">Tutor: </label>
            <div id="nombre" class="form-text">Seleccione un tutor de la lista, use el apartado de búsqueda para agilizar la tarea</div>
        </div>

        <table id="tablaTutores" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO P.</th>
                    <th scope="col">APELLIDO M.</th>
                    <th scope="col">TEL 1</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">COL.</th>
                    <th scope="col">Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tutores as $tutor)
                    <tr>
                        <td>{{ $tutor->id}}</td>
                        <td>{{ $tutor->persona->nombre}}</td>
                        <td>{{ $tutor->persona->apellido_p}}</td>
                        <td>{{ $tutor->persona->apellido_m}}</td>
                        <td>{{ $tutor->telefono_1}}</td>
                        <td>{{ $tutor->correo}}</td>
                        <td>{{ $tutor->colonia}}</td>

                        <td>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="{{ $tutor->id }}°" name="tutor_id" value="{{ $tutor->id }}" 
                                    @if(old('tutor_id')==$tutor->id)
                                        checked
                                    @elseif(($persona->alumno->tutor->id ?? '')==$tutor->id)
                                        checked
                                    @endif>
                                <label class="form-check-label" for="{{ $tutor->id }}°"><---</label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p>NO HAY DATOS PARA MOSTRAR</p>
                @endforelse
            </tbody>
        </table>  
        @error('tutor_id')
            <small class="errores">*{{ $message }}</small>
            <br>
        @enderror
        <br>
        
    </div>

    <div>
        <div class="d-flex justify-content-center">
            <a class="btn btn-warning"  role="button" onclick="mostrarGrupos()">asignar-reasignar/Grupo(sólo lectura)</a>
        </div>
    </div>

    <div class="mb-3" id="cajaGrupos">
        <label for="" class="form-label">Grupo: </label>
        <div id="nombre" class="form-text">Seleccione un grupo de la lista, use el apartado de búsqueda para agilizar la tarea</div>

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
                                <input type="radio" class="form-check-input" id="{{ $grupo->id }}g" name="grupo_id" value="{{ $grupo->id }}" 
                                    @if(old('grupo_id')==$grupo->id)
                                        checked
                                    @elseif(($persona->alumno->grupo->id ?? '')==$grupo->id)
                                        checked
                                    @endif>
                                <label class="form-check-label" for="{{ $grupo->id }}g"><---</label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p>NO HAY DATOS PARA MOSTRAR</p>
                @endforelse
            </tbody>
        </table>  
        @error('grupo_id')
            <small class="errores">*{{ $message }}</small>
            <br>
        @enderror
        <br>
    </div>

@endsection

@section('hrefCancelar')
    /secretarias
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .errores{
            color: rgb(173, 14, 14);
        }
    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaTutores').DataTable();
            $('#tablaGrupos').DataTable();
            document.getElementById("cajaTutorG").style.display = "none";
            document.getElementById("cajaGrupos").style.display = "none";

            if(document.getElementsByName("existeTutor")[1].checked){
                document.getElementById("cajaTutorG").style.display = "block";
                document.getElementById("datosTutor").style.display = "none";
            }

        });

        $('#tablaTutores,#tablaGrupos').DataTable( {
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

        function setGrado(grado){
            document.getElementById('grado').value=grado;
        }
        function mostrarTablas(){
            document.getElementById("datosTutor").style.display = "none";
            document.getElementById("cajaTutorG").style.display = "block";
        }
        function ocultarTablas(){
            document.getElementById("cajaTutorG").style.display = "none";
            document.getElementById("datosTutor").style.display = "block";
        }
        function mostrarGrupos(){
            document.getElementById("cajaGrupos").style.display = "block";
        }
        function setStatus(status){
            document.getElementById('status').value=status;
        }
    </script>
    <script>
        function validarNum(id){

            if(id>10){
                setNum2(id)
            }else{
                var valoresAceptados = /^[0-9]+$/,
                entrada=document.getElementById(id).value;

                if (entrada.match(valoresAceptados)){
                    setNum();
                    setFocus(id+1);
                } else {
                    document.getElementById(id).value="";
                }
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

        function setNum2(id){
            var valoresAceptados = /^[0-9]+$/,
            entrada=document.getElementById(id).value;

            if (entrada.match(valoresAceptados)){
                setNumS()
                setFocus(id+1);
            } else {
                document.getElementById(id).value="";
            }
        }

        function setNumS(){
            var numero='';
            var i = 11;
            while (i <= 20) 
            {
            numero+=document.getElementById(i).value;
            i++;
            }
            document.getElementById('telefono_2').value=numero;
        }

        function setFocus(id){
            
            if(id==21){
                document.getElementById('correo').focus();
            }else{
                document.getElementById(id).focus();
            }
        }
        
    </script>
@endsection