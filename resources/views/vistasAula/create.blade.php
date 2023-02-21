@extends('adminlte::page')

@section('title', 'CREATE_GRUPOS')

@section('content_header')
    <h1>CREAR NUEVA AULA</h1>
@stop

@section('content')
    <!-- un submit activa automaticamnte el metodo store en el controlador NO SE LLAMA-->
    <form action="/aulas" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label><br>
            <small id="nombre" class="form-text">nombre o tag para identificar el aula</small>
            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="emailHelp"
            value="{{ old('nombre') }}">
            <p class="errores">{!! $errors->first('nombre','<span class=error>:message</span>') !!}</p>
            
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Comentarios</label><small>(Opcional)</small>
            <textarea name="comentarios" id="comentarios" class="form-control" value="{{ old('comentarios') }}"></textarea>
            {!! $errors->first('comentarios','<span class=error>:message</span>') !!}
        </div>
        
        
        <!--ambas ban a /aulas la diferencia esque guardar hace un submit antes-->
        <a href="/aulas" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .errores{
            color: brown;
        }
    </style>
@stop

@section('js')
@stop