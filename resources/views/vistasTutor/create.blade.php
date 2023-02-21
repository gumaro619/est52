@extends('vistasPersona.formularioPersona')

@section('header')
    <h1>CREAR NUEVO TUTOR</h1>
    <p>DATOS GENERALES DEL TUTOR</p>
@endsection

@section('actionPOST')
    /tutores
@endsection

@section('inputsFormulario')
    <p>DATOS DE CONTACTO PARA EMERGENCIAS</p>
    
    <div class="mb-3">
        <label for="" class="form-label">Teléfono 1: </label>
        <input type="text" class="form-control" name="telefono_1" id="telefono_1"  value="{{ old('telefono_1') }}" tabindex="6">
        @error('telefono_1')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Teléfono 2: </label>
        <input type="text" class="form-control" id="telefono_2" name="telefono_2" value="{{ old('telefono_2') }}" tabindex="7">
        @error('telefono_2')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Correo electrónico: </label>
        <input type="text" class="form-control" id="correo" name="correo" value="{{ old('correo') }}" tabindex="8">
        @error('correo')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Estado: </label>
        <input type="text" class="form-control" id="estado" name="estado" value="Oaxaca" value="{{ old('estado') }}" tabindex="9">
        @error('estado')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Municipio: </label>
        <input type="text" class="form-control" id="municipio" name="municipio" value="Puerto Ángel" value="{{ old('municipio') }}" tabindex="10">
        @error('municipio')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Colonia: </label>
        <input type="text" class="form-control" id="colonia" name="colonia" value="{{ old('colonia') }}" tabindex="11">
        @error('colonia')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Calle: </label>
        <input type="text" class="form-control" id="calle" name="calle" value="{{ old('calle') }}" tabindex="12">
        @error('calle')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Número: </label>
        <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" tabindex="13">
        @error('numero')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
    </div>

@endsection

@section('tab')
    14
@endsection

@section('hrefCancelar')
    /tutores
@endsection