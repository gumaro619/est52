@extends('adminlte::page')

@section('title', 'Alumnos')
    
@section('content_header')
    @include('modWidgets.mostrarHeader', ['trabajador' => $trabajador])
@stop

@section('content')
    <section id="zonaAcordeon">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->grupo->nombre ?? 'No asignado'}}</td>
                        <td>
                            <form action="{{ route('grupos.destroy',$alumno->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="/grupos/{{ $alumno->id }}/edit" class="btn btn-info">Editar</a>
                                <button type="submit" class="btn btn-outline-dark">Borrar</button>
                            </form>
                        </td>
                        
                    </tr>
                @empty
                    <p>NO HAY DATOS PARA MOSTRAR</p>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>

        
    </section>

    <div style="display: block">
        <table id="listaAlumnos" class="display" style="width:100%">
            <thead class="bg-ligth">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->grupo->nombre ?? 'No asignado'}}</td>
                        <td>
                            <form action="{{ route('grupos.destroy',$alumno->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="/grupos/{{ $alumno->id }}/edit" class="btn btn-info">Editar</a>
                                <button type="submit" class="btn btn-outline-dark">Borrar</button>
                            </form>
                        </td>
                        
                    </tr>
                @empty
                    <p>NO HAY DATOS PARA MOSTRAR</p>
                @endforelse
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        //reacomodamos el primer include 
        //document.getElementById("titulo").textContent = "Ver información estudiantil";
        
    </script> 

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#listaAlumnos').DataTable({
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontró ningún registro",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    paginate: {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                },
                pageLength: 100
            });
        });
    </script>
    

@endsection

