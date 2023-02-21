@extends('adminlte::page')

@section('title', 'Credencial-Alumnado')

@section('content_header')
    <p>COORDINACIÓN -> BAJAS</p>
@stop

@section('content')
    <p>Bienvenid@ al  Sistema integral de información de la EST 52.</p>

    <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Sobre las bajas</h5>
            <p class="card-text">Dar de baja un alumno, ya sea temporal o definitivamente no borrará su registro de la institución, cambiará su status  de "activo " a "dado de baja"</p>
            <a href="#" class="btn btn-primary">!Entendido¡</a>
        </div>
    </div>
    
    <p>Seleccione al alumno y tipo de baja </p>
    <a href="/coordinacion" class="btn btn-primary">Panel Principal</a>
    
    <table id="tablaAlumnos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDO P.</th>
                <th scope="col">APELLIDO M.</th>
                <th scope="col">SEXO</th>
                <th scope="col">EDAD</th>
                <th scope="col">TUTOR</th>
                <th scope="col">STATUS</th>
                <th scope="col">GRUPO</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->id }}</td>
                    <td>{{ $alumno->persona->nombre}}</td>
                    <td>{{ $alumno->persona->apellido_p}}</td>
                    <td>{{ $alumno->persona->apellido_m}}</td>
                    <td>{{ $alumno->persona->sexo}}</td>
                    <td>{{ date_diff(date_create($alumno->persona->fecha_nacimiento), date_create(now()))->format('%y a ,%m m , %d d ')}}</td>
                    <td>{{ ($alumno->tutor->persona->nombre ?? 'No')." ".($alumno->tutor->persona->apellido_p ?? 'Asignado')}}</td>
                    <td>{{ $alumno->status}}</td>
                    <td>{{ $alumno->grupo->nombre ?? 'No asignado'}}</td>
                    <td>
                        <a class="btn btn-info" href="/bajas/temporal/{{ $alumno->id }}"  >Temporal</a>
                        <a class="btn btn-danger" href="/bajas/definitiva/{{ $alumno->id }}" >Definitiva</a>
                    </td>
                    
                </tr>
            @empty
                <p>NO HAY DATOS PARA MOSTRAR</p>
            @endforelse
        </tbody>
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#tablaAlumnos').DataTable();
            });

            $('#tablaAlumnos').DataTable( {
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
@stop