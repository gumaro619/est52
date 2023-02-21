@extends('adminlte::page')

@section('title', 'CREATE_GRUPOS')

@section('content_header')
    <h1>CREAR NUEVO GRUPO</h1>
@stop

@section('content')
    <form action="/grupos" method="POST" name="formGrupo">
        @csrf

        <label for="" class="form-label">Grado : </label><br>
        <div class="btn-group" role="group" aria-label="grado" id="divGrados">

            <input type="radio" class="btn-check" name="grados" id="grados1" onchange="setNombre()"
            value="1" autocomplete="off" @if(old('grados')== null || old('grados')== '1')
                checked
            @endif>
            <label class="btn btn-outline-primary" for="grados1">1° Primer grado</label>
        
            <input type="radio" class="btn-check" name="grados" id="grados2" onchange="setNombre()"
            value="2" autocomplete="off" {{ old('grados')== '2' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="grados2">2° Segundo grado</label>
        
            <input type="radio" class="btn-check" name="grados" id="grados3" onchange="setNombre()"
            value="3" autocomplete="off" {{ old('grados')== '3' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="grados3">3° Tercer grado</label>
            
        </div>
        <br>

        <label for="" class="form-label">Grupo:  </label><br>
        <div class="btn-group" role="group" aria-label="grupo">
            <input type="radio" class="btn-check" name="grupos" id="grupoa" autocomplete="off" 
            value="A" onchange="setGrupoabc()" {{ old('grupos')== null || old('grupos')== 'A' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="grupoa">A</label>
        
            <input type="radio" class="btn-check" name="grupos" id="grupob" 
            value="B" onchange="setGrupoabc()" {{ old('grupos')== 'B' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="grupob">B</label>
        
            <input type="radio" class="btn-check" name="grupos" id="grupoc" 
            value="C" onchange="setGrupoabc()" {{ old('grupos')== 'C' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="grupoc">C</label>

            <input type="radio" class="btn-check" name="grupos" id="grupox" autocomplete="off" 
            value="X" onchange="setGrupoabc()" {{ old('grupos')== 'X' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary"  for="grupox" >Otro</label>

            <input type="text" class="form-control" id="otro" name="otro" placeholder="D,E,F..." value="{{ old('otro') }}"
            maxlength="1" data-show-if="grupox" oninput="setMayus(this)" onclick="setGrupo()">
            {!! $errors->first('grupos','<span class=error>:message</span>') !!}
        </div><br>
        @error('otro')
            <small class="errores">*{{ $message }}</small><br>
        @enderror

        <label for="" class="form-label">CREANDO EL GRUPO: </label><br>
        <input type="text" class="form-control" id="grupoFinal" name="grupoFinal" value="1°A"  readonly>
        @error('grupoFinal')
            <small class="errores">*{{ $message }}</small>
            <br>
        @enderror
        

        <br><label for="" class="form-label">Ciclo escolar: </label>
        <p>Sólo debe  indicar el año inicial</p>
        <br>
        @error('ciclo1')
            <small class="errores">*{{ $message }}</small>
            <br>
        @enderror
        <div class="input-group">
            <input type="number" min="2010" max="2099" step="1"  value="{{ old('ciclo1',date("Y")) }}" class="form-control" name="ciclo1" id="ciclo1"  oninput="setCiclo(this)" onclick="setCiclo(this)">
            

            <label for=""> ---- </label>
            <input type="text" value="{{ old('ciclo2',date("Y")+1) }}" class="form-control" name="ciclo2" id="ciclo2" required readonly>
            <input type="radio" class="btn-check" name="grupos" id="grupox" autocomplete="off" value="X">
            <br>{!! $errors->first('ciclo2','<span class=error>:message</span>') !!}


        </div><br>
        
        <a href="/grupos" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        function setCiclo(input){
            var anio = parseInt(input.value),
                anio2 = anio+=1;
            document.getElementById('ciclo2').value=anio2;
        }

        function setGrupoabc(){
            document.getElementById('otro').value="";
            setNombre();
        }

        function setGrupo(){
            document.getElementById('grupoa').checked = false; 
            document.getElementById('grupob').checked = false; 
            document.getElementById('grupoc').checked = false; 
            document.getElementById('grupox').checked = true; 
            setNombre();
        }


        function setMayus(input){
            document.getElementById('otro').value=input.value.toUpperCase();
            setNombre();
        }

        function setNombre(){
            var grado = getRadio(document.formGrupo.grados),
                grupo = getRadio(document.formGrupo.grupos);
            
                if(grupo=="X"){
                    grupo=document.getElementById('otro').value;
                }

            document.getElementById('grupoFinal').value=grado+"°"+grupo;
        }

        function getRadio(ctrl){
            for(i=0;i<ctrl.length;i++)
                if(ctrl[i].checked) return ctrl[i].value;
    }
    </script>
@stop