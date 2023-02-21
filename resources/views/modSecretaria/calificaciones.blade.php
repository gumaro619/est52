@extends('adminlte::page')

@section('title', 'Boleta-Calificaciones')

@section('content_header')
    <h1>PERÍODO ORDINARIO DE  ASIGNACIÓN DE CALIFICACIONES</h1>
@stop

@section('content')
    <p>Secretari@-> califiacaiones</p>
    <p>Asignar calificaciones  del alumnado en genmeral</p>
    
    <a href="/inscripciones" class="btn btn-primary"> regresar al Panel Principal</a>
    
    <table id="tablaAlumnos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">PERIODO</th>
                <th scope="col">EXAMEN R.</th>
                <th scope="col">CALIFICACIONE M.</th>
                <th scope="col">FALTAS</th>
                <th scope="col">ALUMNO</th>
                <th scope="col">CLASE</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
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