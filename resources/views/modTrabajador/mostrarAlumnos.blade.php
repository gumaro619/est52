@extends('adminlte::page')

@section('title', 'Alumnos')

@section('content_header')
    @include('modWidgets.mostrarHeader', ['trabajador' => $trabajador])
@stop

@section('content')
    <section id="zonaAcordeon">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            @forelse($alumnos as $alumno)
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading{{ $alumno->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $alumno->id }}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{ $alumno->id }}">
                        <strong class="fs-3">{{ $alumno->persona->nombre }} {{ $alumno->persona->apellido_p }} {{ $alumno->persona->apellido_m ?? '' }} - {{ $alumno->grupo->nombre ?? '(sin grupo)' }}</strong>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse{{ $alumno->id }}" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading{{ $alumno->id }}">
                    <div class="accordion-body">
                        <p><strong>Nombre:</strong> {{ $alumno->persona->nombre }}</p>
                        @include('modWidgets.infoAlumnosView', ['alumno' => $alumno])
                    </div>
                </div>
            </div>
            @empty
                <div class="alert alert-info" role="alert">
                    Seleccione un estudiante para  acceder a la información reelevante
                </div>  
            @endforelse
        </div>
    </section>
@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .mycheckbox input:checked ~ span::after{
            background: rgb(12, 167, 12);
            transform: scale(0.85) translate(35px);
        }
        .mycheckbox input:checked ~ span .on{
            transform: translate(30px);
            opacity: 1;
        }

        .mycheckbox input:checked ~ span .off{
            transform: translate(30px);
            opacity: 0;
        }

            .mycheckbox input:checked ~ span .on-bell{
            transform: translate(31px);
        }

            .mycheckbox input {
            display: none;
        }

        .mycheckbox span {
            display: inline-block;
            width: 60px;
            height: 30px;
            border-radius: 30px;
            background: rgb(187, 186, 186);
            cursor: pointer;
            box-shadow: inset 0px 0px 2px rgb(15, 15, 15);

            position: relative;
        }

        .mycheckbox span::after {
            content: "";
            display: block;
            width: 30px;
            height: 30px;
            transform: scale(0.85);
            border-radius: 30px;
            background: rgb(248, 22, 22);
            transition: 0.5s;
            box-shadow: inset 0px 0px 2px rgb(37, 37, 37);
        }

        .mycheckbox i {
            position: absolute;
            left: 7px;
            top: 7px;
            z-index: 1;
            color: white;
            transition: 0.5s;
        }

        .mycheckbox .on {
            opacity: 0;
            left: 7px;
            top: 7px;
        }

        .mycheckbox .off {
            left: 9px;
            top: 7px;
        }

        .mycheckbox .off-bell {
            left: 5px;
        }
        
        .accordion-button {
            color: #fff;
            background-color: #0062cc;
            border-color: #005cbf;
        }
    </style>
    <style>
        .borde {
            border: 1px solid rgb(74, 104, 138);
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        //reacomodamos el primer include 
        document.getElementById("titulo").textContent = "Ver información estudiantil";
    </script>  

@endsection

