@extends('adminlte::page')

@section('title', 'CREATE_GRUPOS')

@section('content_header')
    <h1>CREAR NUEVA MATERIA</h1>
    <style>
        .error{
            color: rgb(182, 20, 20);
        }
    </style>
@stop

@section('content')
    <!-- un submit activa automaticamnte el metodo store() en el controlador que invoca, NO SE LLAMA-->
    <datalist id="materias">
        <option value="ESPAÑOL I"></option>
        <option value="ESPAÑOL II"></option>
        <option value="ESPAÑOL III"></option>
        <option value="MATEMÁTICAS I"></option>
        <option value="MATEMÁTICAS II"></option>
        <option value="MATEMÁTICAS III"></option>
        <option value="BIOLOGÍA"></option>
        <option value="FÍSICA"></option>
        <option value="QUÍMICA"></option>
        <option value="EDUC. FÍSICA"></option>
    </datalist>
    
    <form action="/materias" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre: </label>
            <input type="text" autocomplete="off" list="materias"
                class="form-control" 
                name="nombre" 
                id="nombre" 
                value="{{ old('nombre') }}"
                placeholder=""  
                autofocus>
                @error('nombre')
                    <p class="errores">*{{ $message }}</p><br>
                @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Programa: </label>
            <input type="text" 
                class="form-control" 
                id="programa" 
                name="programa" 
                value="{{ old('programa') }}">
                <span></span>
                @error('programa')
                    <p class="errores">*{{ $message }}</p><br>
                @enderror
        </div>
        
        
        <!--ambas ban a /materias la diferencia esque guardar hace un submit antes-->
        <a href="/materias" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .errores{
            color: rgb(201, 37, 37);
        }
    </style>
@stop

@section('js')
@stop