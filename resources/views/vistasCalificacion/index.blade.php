@extends('vistasPersona.formularioIndexPersona')

@section('header')
    <h1>INDEX CALIFICACIONES</h1>
@endsection

@section('bodi')
    <a href="{{ route('calificaciones.create') }}" class="btn btn-primary" id="btnCrear" class="botones">CREAR</a>
@endsection

@section('columnasTHead')

    <th scope="col">ID</th>
    <th scope="col">ALUMNO</th>
    <th scope="col">GRUPO</th>
    <th scope="col">CLASE</th>
    <th scope="col">PERIODO</th>
    <th scope="col">EXTRAORDINARIO</th>
    <th scope="col">CALIFICACIÓN</th>
    <th scope="col">FALTAS</th>
    

    <th scope="col">Acciones</th>
@endsection

@section('filasTBody')
    @forelse($calificaciones as $calificacion)
        <tr>
            <td>{{ $calificacion->id }}</td>
            <td>{{ $calificacion->alumno->persona->nombre." ".$calificacion->alumno->persona->apellido_p." ".$calificacion->alumno->persona->apellido_m}}</td>
            
            <td>{{ $calificacion->clase->grupo->nombre}}</td>
            <td>{{ $calificacion->clase->materia->nombre}}</td>
            <td>{{ $calificacion->periodo}}</td>
            <td>{{ $calificacion->examenR}}</td>
            <td>{{ $calificacion->calificacion}}</td>
            <td>{{ $calificacion->faltas}}</td>
            

            <td>
                <form action="{{ route('calificaciones.destroy',$calificacion->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <a href="/calificaciones/{{ $calificacion->id }}/edit" class="btn btn-info">Editar</a>
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
        </tr>
        @empty
        <p>NO HAY DATOS PARA MOSTRAR</p>
    @endforelse
@endsection