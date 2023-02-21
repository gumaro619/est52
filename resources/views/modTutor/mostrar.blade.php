@extends('adminlte::page')

@section('title', 'TUTORES')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1 class="text-center">
        <span class="text-primary">
            <i class="fas fa-users"></i>
        </span>
        Panel principal de Tutores
    </h1>
    <p style="text-align: center;" class="fs-5">Bienvenid@ al Sistema integral de información de la EST 52.</p>
@stop

@section('content')



    <div class="tutor-bar">
        <p class="fs-4"> {{ $tutor->persona->nombre.". ".$tutor->persona->apellido_p." ".$tutor->persona->apellido_m}}</p>
    </div>
    <P>Opciones :</P>
    <div class="cajaOpciones">
        <div class="container">
            <div class="row">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Cierre rápido</h5>
                        <p class="card-text">Acceso directo al cirerre de sesión de  forma segura</p>
                        <a href="{{ route('tutor') }}" class="btn btn-primary stretched-link">Cerrar sesión</a>
                        <i class="fa fa-power-off iconos"></i>
                    </div>
                </div>
    
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Preguntas frecuentes</h5>
                        <p class="card-text">¿datos erroneos?¿correcciones?¿Actualizaciones? Es posible que podamos resolver algunas de sus dudas</p>
                        <a href="{{ route('tutor.faqs') }}" class="btn btn-primary stretched-link">ver más</a>
                        <i class="fas fa-question-circle iconos"></i>
                    </div>
                </div>

                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Actualizar mis datos</h5>
                        <p class="card-text">¿Los datos de contacto co que cuenta la escuela son de suma importancia como  vía principal de comunicación en caso de emergencias</p>
                        <a href="/tutor/actualizar/{{ $tutor->id }}" class="btn btn-primary stretched-link">Actualizar</a>
                        <i class="fas fa-sync fa-2x iconos"></i>
                    </div>
                </div>

                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Buzón de quejas y sugerencias</h5>
                        <p class="card-text">Una herramienta de acercamiento a los padres de familia, </p>
                        <a href="/docente/calificaciones/" class="btn btn-primary stretched-link">ir al buzón</a>
                        <i class="fas fa-envelope iconos"></i>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <div class="alert alert-info" role="alert">
        A continuación seleccione su tutorado paara ver la información reelevante
    </div>
    <br>
    <p class="fs-4"></p>


    <table id="tablaAlumnos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">EDAD</th>

                <th scope="col">CURP</th>
                <th scope="col">GRUPO</th>
                <th scope="col">STATUS</th>

                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tutor->alumnos as $alumno)
                <tr>
                    <td>{{ $loop->index+1}}</td>
                    <td>{{ $alumno->persona->nombre}}</td>
                    <td>{{ $alumno->persona->apellido_p." ".$alumno->persona->apellido_m}}</td>
                    <td>{{ date_diff(date_create($alumno->persona->fecha_nacimiento), date_create(now()))->format('%ya %mm %dd')}}</td>

                    <td>{{ $alumno->curp}}</td>
                    <td>{{ $alumno->grupo->nombre ?? 'No asignado'}}</td>

                    <td>{{ $alumno->status}}</td>
                    <td>
                        <a href="/tutor/tutorado/{{ $alumno->id }}" class="btn btn-success">ver a su tutorado</a>
                        <a class="btn btn-warning" onclick="eliminarAlumno('{{ $alumno->persona->nombre }}')">¿No es su tutorado?</a>
                    </td>
                </tr>
                @empty
                <div class="alert alert-danger" role="alert">
                    Parece que ud, no tiene alumnos a cargo en el sistema. Puede acudir a la institución para corroborar su información.
                </div>
                <br>
            @endforelse
        </tbody>
    </table>  

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .card {
            margin: 10px;
        }
        .iconos{
            float: right; 
            bottom: 20px; 
            position: absolute; 
            right: 20px; 
            font-size: 50px; 
            color: rgb(116, 112, 112);
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {
                $('#tablaMaterias').DataTable();
            });
            $('#tablaMaterias').DataTable( {
            language: {
                search: "Buscar:",
                lengthMenu:"Mostrar _MENU_ registros por página",
                zeroRecords:"No se encontró ningún registro",
                info: "Mostrando la página _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros disponibles",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                paginate: {
                    'next':'siguiente',
                    'previous':'anterior'
                }

            }
        } );
        </script>
        <script>
            $('.')
            function eliminarAlumno(nombre){
                Swal.fire({
                    title: 'Está seguro?',
                    text: "Es posible que haya ocurrido un error en los datos, De ser así  favor de confirmar. Se eliminará de su registro a:"+nombre,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                })
            }
            
        </script>
        
@stop

@section('body')
    <body class="sidebar-collapse">
        <h1 class="text-center">
            <span class="text-primary">
                <i class="fas fa-users"></i>
            </span>
            Panel principal de Tutores
        </h1>
    </body>
@stop


