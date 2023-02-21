@extends('adminlte::page')

@section('title', 'Crear persona')

@section('content_header')
    @yield('header')
@stop

@section('content')
    <div class="card card-primary">
        {{-- ------------------------------HEADER --}}
        <div class="card-header">
            <h3 class="card-title">Datos Personales</h3>
        </div>

        {{-- ------------------------------BODY --}}
        <div class="card-body">
            <form action="@yield('actionPOST')" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Nombre: </label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" tabindex="1">
                    @error('nombre')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="" class="form-label">Primer apellido: </label>
                    <input type="text" class="form-control" id="apellido_p" name="apellido_p" value="{{ old('apellido_p') }}" tabindex="2">
                    @error('apellido_p')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="" class="form-label">Segundo apellido: </label>
                    <input type="text" class="form-control" id="apellido_m" name="apellido_m" value="{{ old('apellido_m') }}" tabindex="3"> 
                    @error('apellido_m')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
                </div>
        
                <label class="form-label">Sexo: </label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="masculino" name="sexo" value="M" {{ old('sexo')=='M' ? 'checked' : '' }} tabindex="4">
                    <label class="form-check-label" for="masculino">Masculino</label>
                </div>
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="femenino" name="sexo" value="F" {{ old('sexo')== 'F' ? 'checked' : '' }} tabindex="4">
                    <label class="form-check-label" for="femenino">Femenino</label>
                    <div class="invalid-feedback">Debe seleccionar el sexo</div>
                    <br>
                    @error('sexo')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="" class="form-label">Fecha de nacimiento: </label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" tabindex="5">
                    @error('fecha_nacimiento')
                        <small class="errores">*{{ $message }}</small>
                        <br>
                    @enderror
                </div>
                
                @yield('inputsFormulario')
                
                <!--ambas ban a /personas la diferencia esque guardar hace un submit antes-->
                {{-- ------------------------------FOOTER --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" tabindex="@yield('tab')">Guardar</button>
                    <a href="@yield('hrefCancelar')" class="btn btn-secondary" >Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <!-- un submit activa automaticamnte  el metodo store() en el controlador que invoca, NO SE LLAMA-->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .errores{
            color: rgb(173, 14, 14);
        }
    </style>
    @yield('css')
@stop

@section('js')
    @yield('js')
@stop