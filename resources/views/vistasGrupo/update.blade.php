@extends('adminlte::page')

@section('title', 'UPDATE_GRUPOS')

@section('content_header')
    <h1>EDITAR  GRUPO :</h1>
    <p>{{ $grupo->nombre }} /</p>
    <p>{{ $grupo->ciclo }}</p>
@stop

@section('content')

    <form action="/grupos/{{ $grupo->id }}" method="POST" name="formGrupo">
        @csrf
        @method('PUT')

        
        <label for="" class="form-label">Grado : </label><br>
        <div class="btn-group" role="group" aria-label="grado" id="divGrados">

            <input type="radio" class="btn-check" name="grados" id="grados1" onclick="setNombre()"
            value="1" autocomplete="off" @if(old('grados')== null && $grupo->nombre[0] == '1')
                checked
            @elseif(old('grados')=='1')
                checked
            @endif>
            <label class="btn btn-outline-primary" for="grados1">1° Primer grado</label>

            <input type="radio" class="btn-check" name="grados" id="grados2" onclick="setNombre()"
            value="2" autocomplete="off" @if(old('grados')== null && $grupo->nombre[0] == '2')
                checked
            @elseif(old('grados')=='2')
                checked
            @endif>
            <label class="btn btn-outline-primary" for="grados2">2° Segundo grado</label>

            <input type="radio" class="btn-check" name="grados" id="grados3" onclick="setNombre()"
            value="3" autocomplete="off" @if(old('grados')==null && $grupo->nombre[0]=='3')
                checked
            @elseif(old('grados')=='3')
                checked
            @endif>
            <label class="btn btn-outline-primary" for="grados3">3° Tercer grado</label>
            
        </div>
        <br>

        <label for="" class="form-label">Grupo:  </label><br>
        <div class="btn-group" role="group" aria-label="grupo">
            
            <input type="radio" class="btn-check" name="grupos" id="grupoa" value="A" onclick="setGrupoabc()" 
            @if($grupo->nombre[3]=='A'&& old('grupos')==null)
                checked
            @elseif(old('grupos')=='A')
                checked
            @endif>
            <label class="btn btn-outline-primary" for="grupoa">A</label>
        
            <input type="radio" class="btn-check" name="grupos" id="grupob" value="B" onclick="setGrupoabc()" 
            @if(old('grupos')=='B')
                checked
            @elseif($grupo->nombre[3]=='B'&& old('grupos')==null)
                checked
            @endif>
            <label class="btn btn-outline-primary" for="grupob">B</label>
        
            <input type="radio" class="btn-check" name="grupos" id="grupoc" value="C" onclick="setGrupoabc()" 
            @if(old('grupos')=='C')
                checked
            @elseif($grupo->nombre[3]=='C'&& old('grupos')==null)
                checked
            @endif>
            <label class="btn btn-outline-primary" for="grupoc">C</label>

            <input type="radio" class="btn-check" name="grupos" id="grupox" value="X" onclick="setGrupoabc()" 
            @if(old('grupos')=='X')
                checked
            @elseif($grupo->nombre[3]!=='A' && $grupo->nombre[3]!=='B' && $grupo->nombre[3]!=='C' && old('grupos')==null)
                checked
            @endif>
            <label class="btn btn-outline-primary"  for="grupox" >Otro</label>
            

            <input type="text" class="form-control" id="otro" name="otro" placeholder="D,E,F..." oninput="setMayus(this)" onclick="setGrupo()" 
            value="{{ old('otro',($grupo->nombre[3]!=='A'&&$grupo->nombre[3]!=='B'&&$grupo->nombre[3]!=='C') ? $grupo->nombre[3] : '') }}">
            {!! $errors->first('grupos','<span class=error>:message</span>') !!}

            
        </div><br>
        @error('otro')
            <small class="errores">*{{ $message }}</small><br>
        @enderror

        <label for="" class="form-label">CREANDO EL GRUPO: </label><br>
        <input type="text" class="form-control" id="grupoFinal" name="grupoFinal" readonly value="{{ old('grupoFinal',$grupo->nombre) }}">
        @error('grupoFinal')
            <small class="errores">*{{ $message }}</small>
            <br>
        @enderror

        <br><label for="" class="form-label">Ciclo escolar: </label>
        @error('ciclo1')
            <small class="errores">*{{ $message }}</small>
            <br>
        @enderror
        <p>Sólo debe  indicar el año inicial</p>
        <div class="input-group">
            <input type="number" min="2010" max="2099" step="1"  value="{{ old('ciclo1',substr($grupo->ciclo, 0, 4)) }}" class="form-control" 
            name="ciclo1" id="ciclo1"  oninput="setCiclo(this)" onclick="setCiclo(this)">
            

            <label for=""> --- </label>
            <input type="text" value="{{ old('ciclo2',(substr($grupo->ciclo, 0, 4))+1) }}" class="form-control" name="ciclo2" id="ciclo2" required readonly>
            <input type="radio" class="btn-check" name="grupos" id="grupox" autocomplete="off" value="X">
            <br>{!! $errors->first('ciclo2','<span class=error>:message</span>') !!}
        </div><br>
        
        
        <br>
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
        setNombre();
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