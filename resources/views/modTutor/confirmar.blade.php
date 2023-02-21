@extends('adminlte::page')

@section('title', 'TUTORES')

@section('content_header')
    
@stop

@section('content')
    <p class="fs-4">Bienvenid@ al  Sistema integral de información de la EST 52.</p>
    <p class="fs-3">Confirme sus datos (sesión de usuarios)</p>
    <br>

    <table id="tablaTutores" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDO P.</th>
                <th scope="col">APELLIDO M.</th>
                <th scope="col">SEXO</th>
                <th scope="col">NACIMIENTO</th>

                <th scope="col">TEL 1</th>
                <th scope="col">TEL 2</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ESTADO</th>
                <th scope="col">MUNICIPIO</th>
                <th scope="col">COL.</th>
                <th scope="col">CALLE</th>
                <th scope="col">NUM</th>
                <th scope="col">Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($tutores as $tutor)
                <tr>
                    <td>{{ $tutor->id }}</td>
                    <td>{{ $tutor->persona->nombre}}</td>
                    <td>{{ $tutor->persona->apellido_p}}</td>
                    <td>{{ $tutor->persona->apellido_m}}</td>
                    <td>{{ $tutor->persona->sexo}}</td>
                    <td>{{ $tutor->persona->fecha_nacimiento}}</td>

                    <td>{{ $tutor->telefono_1}}</td>
                    <td>{{ $tutor->telefono_2}}</td>
                    <td>{{ $tutor->correo }}</td>
                    <td>{{ $tutor->estado}}</td>
                    <td>{{ $tutor->municipio}}</td>
                    <td>{{ $tutor->colonia}}</td>
                    <td>{{ $tutor->calle}}</td>
                    <td>{{ $tutor->numero}}</td>

                    <td>
                        <a href="/tutor/mostrar/{{ $tutor->id }}" class="btn btn-info">Confirmar</a>
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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

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
        
@stop