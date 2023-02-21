@extends('adminlte::page')

@section('title', 'Indice_clases')

@section('content_header')
    <h1>TODAS LAS CLASES</h1>
@stop

@section('content')
    <p>Bienvenid@ al  Sistema integral de información de la EST 52.</p>
    <br>
    <a href="{{ route('clases.create') }}" class="btn btn-primary" id="btnCrear" class="botones">Crear nueva clase</a>

    <table id="tablaClases" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>

                <th scope="col">ID</th>
                <th scope="col">MATERIA</th>
                <th scope="col">HORA</th>
                <th scope="col">GRUPO</th>
                <th scope="col">DOCENTE</th>
                <th scope="col">DÍAS</th>
                
                
                <th scope="col">AULA</th>
                <th scope="col">Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($clases as $clase)
                <tr>
                <td>{{ $clase->id }}</td>
                <td>{{ $clase->materia->nombre}}</td>
                <td>{{ substr($clase->horaE, 0, 5)."  -  ".substr($clase->horaS, 0, 5)}}</td>
                <td>{{ $clase->grupo->nombre}}</td>
                <td>{{ $clase->docente->trabajador->persona->nombre." ".$clase->docente->trabajador->persona->apellido_p}}</td>
                <td>
                    <div>
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <input type="checkbox" class="btn-check" id="L" disabled @if(str_contains($clase->dias, "L"))
                                checked
                            @endif>
                            <label class="btn btn-outline-primary" for="L">Lu</label>
    
                            <input type="checkbox" class="btn-check" id="M" disabled @if(str_contains($clase->dias, "M"))
                                checked
                            @endif>
                            <label class="btn btn-outline-primary" for="M">Ma</label>
    
                            <input type="checkbox" class="btn-check" id="W" disabled @if(str_contains($clase->dias, "W"))
                                checked
                            @endif>
                            <label class="btn btn-outline-primary" for="W">Mi</label>
    
                            <input type="checkbox" class="btn-check" id="J" disabled @if(str_contains($clase->dias, "J"))
                                checked
                            @endif>
                            <label class="btn btn-outline-primary" for="J">Ju</label>
    
                            <input type="checkbox" class="btn-check" id="V" disabled @if(str_contains($clase->dias, "V"))
                                checked
                            @endif>
                            <label class="btn btn-outline-primary" for="V">Vi</label>
                        </div>
                    </div>
                </td>
                
                <td>{{ $clase->aula->nombre ?? 'No asignado'}}</td>
    
                <td>
                    <form action="{{ route('clases.destroy',$clase->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <a href="/clases/{{ $clase->id }}/edit" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
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
                $('#tablaClases').DataTable();
            });
            $('#tablaClases').DataTable( {
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop





