@extends('vistasAlumno.plantillaCreate')

@section('header')
    <div id="cajaHeader">
        <h1 class="text-center" id="titulo">
            <span class="text-primary">
                <i class="fas fa-user-tie"></i>
            </span>
            Formato de inscripción del Alumno
        </h1>
        <p style="text-align: center;" class="fs-5">Sistema integral de información de la EST 52</p>
        
        
        {{-- <p style="text-align: center;" class="fs-5">Sistema integral de información de la EST 52 ->
            <b>{{ $trabajador->persona->apellido_p }} {{ $trabajador->persona->apellido_m ?? '' }} {{ $trabajador->persona->nombre[0] }}.</b>
        </p> --}}
    </div>
@endsection

@section('actionPOST')
    /inscripciones
@endsection

@section('datosAdicionales')
    <div class="card card-success">
        {{-- ------------------------------HEADER --}}
        <div class="card-header">
            <h3 class="card-title">Datos del tutor</h3>
        </div>

        {{-- ------------------------------BODY --}}
        <div class="card-body">
            <label class="form-label">¿TUTOR EXISTENTE?: </label>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="nuevoTutor" name="existeTutor" value="no" {{ old('existeTutor')=='si' ? '' : 'checked' }} onclick="ocultarTutores()" tabindex="10">
                <label class="form-check-label" for="nuevoTutor">Nuevo tutor</label>
            </div>
            <div class="form-check mb-3">
                <input type="radio" class="form-check-input" id="selectTutor" name="existeTutor" value="si" {{ old('existeTutor')== 'si' ? 'checked' : '' }} onclick="mostrarTutores()">
                <label class="form-check-label" for="selectTutor">Seleccionar tutor</label>
                <br>
                @error('existeTutor')
                <small class="errores">*{{ $message }}</small>
                <br>
                @enderror
            </div>

            <section id="caja" class="cajas">
                <p>Utilice la herramienta de búsqueda para agilizar la tarea</p>
                <table id="tablaTutores" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                    <thead class="bg-primary text-white">
                        <tr>
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
                            <td>{{ $tutor->persona->nombre}}</td>
                            <td>{{ $tutor->persona->apellido_p}}</td>
                            <td>{{ $tutor->persona->apellido_m}}</td>
                            <td>{{ $tutor->telefono_1}}</td>
                            <td>{{ $tutor->correo}}</td>
                            <td>{{ $tutor->colonia}}</td>

                            <td>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="{{ $tutor->id }}°" name="tutor_id" value="{{ $tutor->id }}" {{ old('tutor_id') == $tutor->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $tutor->id }}°"> </label>
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
            </section>

            <section id="caja2" class="cajas">
                <p>NUEVO TUTOR</p>

                <div class="mb-3">
                    <label for="" class="form-label">Nombre: </label>
                    <input type="text" class="form-control" name="nombreTutor" id="nombreTutor" value="{{ old('nombreTutor') }}" tabindex="11">
                    @error('nombreTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Apellido_p: </label>
                    <input type="text" class="form-control" id="apellido_p" name="apellido_pTutor" value="{{ old('apellido_pTutor') }}" tabindex="11">
                    @error('apellido_pTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Apellido_m: </label>
                    <input type="text" class="form-control" id="apellido_mTutor" name="apellido_mTutor" value="{{ old('apellido_mTutor') }}" tabindex="11">
                    @error('apellido_mTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <label class="form-label">Sexo: </label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="masculinoTutor" name="sexoTutor" value="M" {{ old('sexoTutor')=='M' ? 'checked' : '' }} tabindex="12">
                    <label class="form-check-label" for="masculinoTutor">Masculino</label>
                </div>
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="femeninoTutor" name="sexoTutor" value="F" {{ old('sexoTutor')== 'F' ? 'checked' : '' }}>
                    <label class="form-check-label" for="femeninoTutor">Femenino</label>
                    <div class="invalid-feedback">Debe seleccionar el sexo</div>
                    <br>
                    @error('sexoTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Fecha de nacimiento: </label>
                    <input type="date" class="form-control" id="fecha_nacimientoTutor" name="fecha_nacimientoTutor" value="{{ old('fecha_nacimientoTutor') }}" tabindex="13">
                    @error('fecha_nacimientoTutor')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Teléfono principal: </label><br>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-center">
                                <small class="leyenda">A continuación introduzca los 10 dígitos del número telefónico</small>
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
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="telefono_1" id="telefono_1" value="{{ old('telefono_1') }}" readonly style="text-align: center;">
                        </div>
                    </div>
                    @error('telefono_1')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Teléfono Secundario: </label><br>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-center">
                                <small class="leyenda">A continuación introduzca los 10 dígitos del número telefónico</small>
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
                                    <input type="text" class="form-control" maxlength="1" name="14" id="14" style="text-align:center;" oninput="validarNum(14)" value="{{ old('14') }}">
                                    <label for="" class="form-label"></label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" maxlength="1" name="15" id="15" style="text-align:center;" oninput="validarNum(15)" value="{{ old('15') }}">
                                    <label for="" class="form-label"></label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" maxlength="1" name="16" id="16" style="text-align:center;" oninput="validarNum(16)" value="{{ old('16') }}">
                                    <label for="" class="form-label"></label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" maxlength="1" name="17" id="17" style="text-align:center;" oninput="validarNum(17)" value="{{ old('17') }}">
                                    <label for="" class="form-label"></label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" maxlength="1" name="18" id="18" style="text-align:center;" oninput="validarNum(18)" value="{{ old('18') }}">
                                    <label for="" class="form-label"></label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" maxlength="1" name="19" id="19" style="text-align:center;" oninput="validarNum(19)" value="{{ old('19') }}">
                                    <label for="" class="form-label"></label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" maxlength="1" name="20" id="20" style="text-align:center;" oninput="validarNum(20)" value="{{ old('20') }}">
                                    <label for="" class="form-label"></label>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="telefono_2" name="telefono_2" value="{{ old('telefono_2') }}" readonly tabindex="-1" style="text-align: center;">
                        </div>
                    </div>
                    @error('telefono_2')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Correo electrónico: </label>
                    <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}" tabindex="16">
                    @error('correo')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Estado: </label>
                    <input type="text" class="form-control" id="estado" name="estado" value="Oaxaca" value="{{ old('estado') }}" tabindex="17">
                    @error('estado')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Municipio: </label>
                    <input type="text" class="form-control" id="municipio" name="municipio" value="Puerto Ángel" value="{{ old('municipio') }}" tabindex="18">
                    @error('municipio')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Colonia: </label>
                    <input type="text" class="form-control" id="colonia" name="colonia" value="{{ old('colonia') }}" tabindex="19">
                    @error('colonia')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Calle: </label>
                    <input type="text" class="form-control" id="calle" name="calle" value="{{ old('calle') }}" tabindex="20">
                    @error('calle')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Número: </label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" tabindex="21">
                    @error('numero')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                    @enderror
                </div>
            </section>
        </div>

        {{-- ------------------------------FOOTER --}}
        <div class="card-footer">
        </div>
    </div>
@endsection

@section('tab')
    22
@endsection

@section('hrefCancelar')
    /inscripciones
@endsection

@section('css') 
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        #caja{
            display:none;
        }

        .cajas{
            background: rgb(228, 249, 255);
        }

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

            if(document.getElementsByName("existeTutor")[1].checked){
                document.getElementById("caja").style.display = "block";
                document.getElementById("caja2").style.display = "none";
            }
            
            document.getElementById("fecha_nacimiento").textContent += "10/10/2021";
            
        });

        $('#tablaTutores').DataTable( {
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
        function ocultarTutores() {
            document.getElementById("caja").style.display = "none";
            document.getElementById("caja2").style.display = "block";
        }
        function mostrarTutores() {
            document.getElementById("caja").style.display = "block";
            document.getElementById("caja2").style.display = "none";
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

