@extends('adminlte::page')

@section('title', 'Boleta-Calificaciones')

@section('content_header')
    <h1>BOLETA DE CALIFICACIONES</h1>
@stop

@section('content')
    <p>Secretari@-> califiacaiones</p>
    <p>Asignar calificaciones  del alumnado en genmeral</p>
    
    <a href="/inscripciones" class="btn btn-primary"> regresar al Panel Principal</a>
    
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
                <th scope="col">GRUPO</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->persona->id }}</td>
                    <td>{{ $alumno->persona->nombre}}</td>
                    <td>{{ $alumno->persona->apellido_p}}</td>
                    <td>{{ $alumno->persona->apellido_m}}</td>
                    <td>{{ $alumno->persona->sexo}}</td>
                    <td>{{ date_diff(date_create($alumno->persona->fecha_nacimiento), date_create(now()))->format('%y a ,%m m , %d d ')}}</td>
                    <td>{{ ($alumno->tutor->persona->nombre ?? 'No')." ".($alumno->tutor->persona->apellido_p ?? 'asignado')}}</td>
                    <td>{{ $alumno->grupo->nombre ?? 'No asignado'}}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('boletas.show',$alumno->id) }}"  target="_blank">Consultar</a>
                        <a class="btn btn-success" href="{{ route('boletas.edit',$alumno->id) }}"  target="_blank">Descargar</a>
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
        </script>
@stop