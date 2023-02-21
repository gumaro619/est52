@extends('adminlte::page')

@section('title', 'TUTORES')
    
@section('content_header')
    <div class="row g-3">
        <div class="col-md-10">
            <p class="fs-2"> Prefectura</p>
        </div>  
        <div class="col-md-2">
            <div class="d-flex justify-content-end">
                <a href="{{ url()->previous() }}" class="btn btn-warning">Salir de la sesión</a><br>
            </div>
        </div>  
    </div>
    
@stop

@section('content')
    <p class="fs-5">Bienvenid@¡ {{ $trabajador->persona->apellido_p }} {{ $trabajador->persona->apellido_m ?? '' }} {{ $trabajador->persona->nombre[0] }}</p>
    <p class="fs-3"> formulario rápido de  generación de reportes</p>

    <form action="{{ route('trabajador.reportar') }}" method="POST">
        @csrf
        <!--  datos ocultos  -->
        <div class="alert alert-info" role="alert">
            Ingrese rápidamente  el nombre(s), apellidos y/o grupo  para seleccionar a un alumno, puede seleccionar uno o varios alumnos aantes de enviar el formulario
        </div>
        <input type="hidden" class="form-control" name="trabajador_id" id="trabajador_id" value="{{ $trabajador->id }}" >

        <div class="d-flex justify-content-center">
            <div class="col-md-6">
                <label for="" class="form-label">Asunto : </label>
                <input type="text" class="form-control" name="asunto" id="asunto" value="PENDIENTE" >
            </div>  
            <div class="col-md-6">
                <label for="" class="form-label">Fecha (hoy): </label>
                <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha',now()->toDateString()) }}" >
            </div>        
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <div class="col-md-6" style="background-color: rgb(255, 231, 224)">
                <select class="js-example-basic-multiple form-select form-select-lg mb-3" aria-label=".form-select-lg example" multiple="multiple" name="idAlumnos[]"> 
                    @foreach($alumnos as $alumno)
                        <option value="{{ $alumno->id }}">{{ $alumno->persona->nombre }} {{ $alumno->persona->apellido_p }} {{ $alumno->persona->apellido_m ?? '' }} - {{ $alumno->grupo->nombre ?? '(sin grupo)' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div id="btns" class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success btn-lg" tabindex="">Generar reporte(s) rápido(s)</button>
        </div>
        
    </form>

    <div id="info">
        <br>
        <div>
            <div class="alert alert-warning" role="alert">
                El formulario rápido de reportes le permite crear reportes ágilmente  guardando sólo la información primordial, Una vez guardados tendrá la oportunidad de describir los detalles de la misma
            </div>
        </div>
    </div>
    
        


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        function refrescar(){
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();
            document.getElementById('fecha').value=day+"/"+month+"/"+year;

        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop

@section('body')
    <body class="sidebar-collapse">
@stop

