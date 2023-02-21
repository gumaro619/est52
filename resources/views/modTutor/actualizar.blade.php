@extends('adminlte::page')

@section('title', 'Actualizar')

@section('content_header')

@stop

@section('content')

    <p class="fs-1">Editar datos de contacto </p>
    <a href="/tutor/mostrar/{{ $tutor->id }}" type="button" class="btn btn-primary btn-lg">regresar al panel principal</a>
    <div class="alert alert-info" role="alert">
            Sólo puede editar datos específicos, si necesita cambiar algún otro dato  debe acudir  a la institución y solicitar una corrección de datos
    </div>
    <br>
    <p class="fs-4"></p>

    <form action="{{ route('tutor.store') }}" method="POST">
        @csrf
            <div class="cajadatosPersona row g-3">
                <div class="col-md-4">
                    <label for="" class="form-label">Nombre: </label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre', $tutor->persona->nombre) }}" disabled>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Primer Apellido : </label>
                    <input type="text" class="form-control" value="{{ old('apellido_p', $tutor->persona->apellido_p) }}" disabled>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Segundo Apellido: </label>
                    <input type="text" class="form-control" value="{{ old('apellido_m', $tutor->persona->apellido_m) }}" disabled>
                </div>
                
            </div>

        <br>    
        </div>
        
        <p class="fs-5" style="text-align: center">DATOS DE CONTACTO PARA EMERGENCIAS</p>

        <input type="hidden" name="tutor_id" id="tutor_id" value="{{ $tutor->id }}">
        <div class="alert alert-warning" role="alert" id="alerta2">
            Debe ingresar datos nuevos para poder ver las opciones de guardado
        </div>
        <div id="cajaBotones" @if($errors->isEmpty())
            style="display: none"
        @endif>
            <button type="submit" class="btn btn-primary" tabindex="">Actualizar</button>
            <a href="/tutor/mostrar/{{ $tutor->id }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
        </div>
        <div style="background-color: rgb(213, 255, 255)">
            <div class="mb-3">
                <label for="" class="form-label">Teléfono principal: </label><br><small>Actual->{{ $num =$tutor->telefono_1 ?? 'sin registro' }}</small><br>
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
                <label for="" class="form-label">Teléfono Secundario: </label><br><small>Actual->{{ $num2 =$tutor->telefono_2 ?? 'sin registro' }}</small><br>
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
                                <input type="text" maxlength="1" class="form-control" name="13" id="13" style="text-align:center;" oninput="validarNum(13)" value="{{ old('13') }}" onchange="mostrarBotones()">
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
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo',$tutor->correo ?? '') }}" 
                tabindex="16" placeholder="sin asignar" oninput="botones()">
                @error('correo')
                    <small class="errores">*{{ $message }}</small>
                    <br>
                @enderror
            </div>
        </div>


        <div class="cajadatosPersona row g-3">
            <div class="col-md-6">
                <label for="" class="form-label">Estado: </label>
                <input type="text" class="form-control"  value="{{ old('estado',$tutor->estado) }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Municipio: </label>
                <input type="text" class="form-control" value="{{ old('municipio',$tutor->municipio) }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Colonia: </label>
                <input type="text" class="form-control" value="{{ old('colonia',$tutor->colonia) }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Calle: </label>
                <input type="text" class="form-control" value="{{ old('calle',$tutor->calle) }}" disabled>
            </div>
            <div class="col-md-4" style="background-color: rgb(213, 255, 255)">
                <label for="" class="form-label">Número: </label>
                <input type="text" placeholder="opcional" class="form-control" id="numero" name="numero" value="{{ old('numero',$tutor->numero) }}">
            </div>
        </div>
        <br>
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .errores{
            color: rgb(173, 14, 14);
        }
    </style>
@stop

@section('js')
    <script>
        function botones(){
            document.getElementById("cajaBotones").style.display = "block";
        }

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

                if(id==10){
                    document.getElementById("cajaBotones").style.display = "block";
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
    
            if(id==20){
                document.getElementById("cajaBotones").style.display = "block";
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
@stop