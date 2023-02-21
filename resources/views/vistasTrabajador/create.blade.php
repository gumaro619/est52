@extends('vistasPersona.formularioPersona')

@section('header')
    <h1>CREAR NUEVO TRABAJADOR</h1>
    <p>DATOS GENERALES DEL NUEVO TRABAJDOR</p>
@endsection

@section('actionPOST')
    /trabajadores
@endsection

@section('inputsFormulario')
    <p>DATOS INSTITUCIONALES</p>
    <br>
    <label for="" class="form-label">Puesto : </label><br>
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <small>Sugerencias:</small>
        </div>
        <div class="d-flex justify-content-center"> 
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-primary" onclick="setPuesto('PREFECTO')">PREFECTO(A)</button>
            </div>
    
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-info" onclick="setPuesto('SECRETARIO')">SECRETARIO(A)</button>
            </div>
    
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-success" onclick="setPuesto('ORIENTADOR')">ORIENTADOR(RA) Ac.</button>
            </div>

            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-warning" onclick="setPuesto('COORDINADOR')">COORDINADOR ACADÉMICO</button>
            </div>
    
            <div class="form-check form-check-inline">
                <button type="button" class="btn btn-danger" onclick="setPuesto('SUBDIRECTOR')">DIRECTIVO</button>
                <label class="form-check-label" for="radio5Puuntos">->(unicamente para sub-directores)</label>
            </div>
        </div>
    </div>

    <div class="">
        <input type="text" class="form-control" name="puesto" id="puesto" value="{{ old('puesto') }}" placeholder="Detalle el puesto" tabindex="6" readonly>
        @error('puesto')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Teléfono: </label><br>
        <div class="d-flex justify-content-center"> 
            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    <small class="leyenda" >A continuación introduzca los 10 dígitos del número telefónico</small>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-md-1">
                        <input type="text" maxlength="1" class="form-control" name="1" id="1" style="text-align:center;" oninput="validarNum(1)" tabindex="6" value="{{ old('1') }}">
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
                        <input type="text" class="form-control" maxlength="1" name="4" id="4" style="text-align:center;" oninput="validarNum(4)" tabindex="7" value="{{ old('4') }}">
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
        

        <input type="text" class="form-control" id="telefono" name="telefono" tabindex="-1" value="{{ old('telefono') }}" readonly>
        @error('telefono')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Correo electrónico: </label>
        <input type="email" class="form-control" id="11" name="correo" tabindex="8" onclick="prueba()" value="{{ old('correo') }}">
        @error('correo')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Horas semanales: </label>
        <input type="text" class="form-control" id="horas" placeholder="Si desea omitir el dato ingrese 0" value="{{ old('horas') }}" name="horas" tabindex="9" oninput="validarNum('horas')">
        @error('horas')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Status del trabajador: </label><br>
        <div class="form-check form-check-inline">
            <small>Sugerencias:</small>
        </div>
        <div class="form-check form-check-inline">
            <button type="button" class="btn btn-success" onclick="setStatus('activo')">activo</button>
            <label class="form-check-label" for="radio1Punto">(Sólo docentes activos están dados de alta en el sistema)</label>
        </div>
        <div class="form-check form-check-inline">
            <button type="button" class="btn btn-secondary" onclick="setStatus('inactivo')">inactivo</button>
            <label class="form-check-label" for="radio3Puntos"> (usuario sin acceso)</label>
        </div>

        <div class="form-check form-check-inline">
            <button type="button" class="btn btn-warning" onclick="setStatus('pendiente')">pendiente</button>
            <label class="form-check-label" for="radio5Puuntos">(sin acceso hasta ser aprobado por un directivo)</label>
        </div>

        <input type="text" class="form-control" id="status" name="status" tabindex="10" value="{{ old('status','activo') }}" readonly>
        @error('status')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>
@endsection

@section('tab')
    11
@endsection

@section('hrefCancelar')
    /trabajadores
@endsection

@section('js')
    <script>
        function setPuesto(puesto){
            document.getElementById('puesto').value=puesto;
            document.getElementById('puesto').focus();

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

        function setNum(){
            var numero='';

            var i = 1;
            while (i <= 10) 
            {
            numero+=document.getElementById(i).value;
            i++;
            }
            document.getElementById('telefono').value=numero;
        }
        function setFocus(id){
            document.getElementById(id).focus();
        }

        function setStatus(status){
            document.getElementById('status').value=status;
        }

    </script>
@endsection