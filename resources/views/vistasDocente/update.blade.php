@extends('vistasPersona.formularioEditPersona')

@section('header')
    <h1>EDITAR DOCENTE</h1>
    <p>DATOS GENERALES DEL DOCENTE</p>
@endsection

@section('actionPOST')
    /docentes/{{ $persona->trabajador->id}}
@endsection

@section('inputsFormulario')
    <p>DATOS INSTITUCIONALES</p>
        
    <div class="mb-3">
        <label for="" class="form-label">Puesto: </label>
        <input type="text" class="form-control" name="puesto" id="puesto" value="DOCENTE" readonly tabindex="-1">
        @error('puesto')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Teléfono Secundario: </label><br><small>Actual->{{ $persona->trabajador->telefono ?? 'sin registro' }}</small><br>
        <div class="d-flex justify-content-center"> 
            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    <small class="leyenda" >Asignar/aActualizar número telefónico</small>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-md-1">
                        <input type="text" maxlength="1" class="form-control" name="1" id="1" style="text-align:center;" oninput="validarNum(1)" tabindex="6" value="{{ old('1') }}">
                        <label for="" class="form-label"></label>
                    </div>
                    <div class="col-md-1">
                        <input type="text" maxlength="1" class="form-control" name="2" id="2" style="text-align:center;" oninput="validarNum(2)" value="{{ old('2')}}">
                        <label for="" class="form-label"></label>
                    </div>
                    <div class="col-md-1">
                        <input type="text" maxlength="1" class="form-control" name="3" id="3" style="text-align:center;" oninput="validarNum(3)" value="{{ old('3')}}">
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
        
        <div class="d-flex justify-content-center">
            <small>Nuevo-></small>
            <div class="col-md-2">
                <input type="text" class="form-control" id="telefono" name="telefono" tabindex="-1" value="{{ old('telefono',$persona->trabajador->telefono) }}" readonly>
            </div>
        </div>
        @error('telefono')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Correo electrónico: </label>
        <input type="email" class="form-control" id="11" name="correo" tabindex="8" onclick="prueba()" value="{{ old('correo',$persona->trabajador->correo) }}">
        @error('correo')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Status del trabajador: </label><br>
        <div class="form-check form-check-inline">
            <small>Sugerencias:</small>
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

        <input type="text" class="form-control" id="status" name="status" tabindex="9" readonly @if($persona->trabajador->status==1)
            value="activo"
        @elseif($persona->trabajador->status==0)
            value="inactivo"
        @else
            value="pendiente"
        @endif>
        @error('status')
            <small class="errores">*{{ $message }}</small><br>
        @enderror
    </div>
        
@endsection

@section('tab')
    10
@endsection

@section('hrefCancelar')
    /docentes
@endsection

@section('js')
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
            document.getElementById('telefono').value=numero;
        }
        function setFocus(id){
            document.getElementById(id).focus();
        }

        function setStatus(status){
            document.getElementById('status').value=status;
        }
        
    </script>
    <script>
        function resetTel(){
            document.getElementById('3').value="";
            document.getElementById('2').value=="";
            document.getElementById('3').value=="";
            document.getElementById('4').value=="";
            document.getElementById('5').value=="";
            document.getElementById('6').value=="";
            document.getElementById('7').value=="";
            document.getElementById("8").value=="";
            document.getElementById("9").value=="";
            document.getElementById("10").value=="";

            document.getElementById(1).focus();
        }
    </script>
@stop