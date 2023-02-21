@extends('vistasPersona.formularioIndexPersona')

@section('header')
    <h1>ADMINISTRAR  ALUMNOS</h1>
@endsection

@section('bodi')
    <a href="{{ route('alumnos.create') }}" class="btn btn-primary" id="btnCrear" class="botones">CREAR</a>
@endsection

@section('columnasTHead')

    <th scope="col">ID</th>
    <th scope="col">NOMBRE</th>
    <th scope="col">APELLIDO P.</th>
    <th scope="col">APELLIDO M.</th>
    <th scope="col">SEXO</th>
    <th scope="col">NACIMIENTO</th>
    <th scope="col">AÑOS</th>

    <th scope="col">CURP</th>
    <th scope="col">STATUS</th>
    <th scope="col">FECHA DE INSCRIPCIÓN</th>
    <th scope="col">GRUPO</th>
    <th scope="col">TUTOR</th>
    <th scope="col">Acciones</th>
@endsection

@section('filasTBody')
    @forelse($alumnos as $alumno)
        <tr>
            <td>{{ $alumno->id}}</td>
            <td>{{ $alumno->persona->nombre}}</td>
            <td>{{ $alumno->persona->apellido_p}}</td>
            <td>{{ $alumno->persona->apellido_m}}</td>
            <td>{{ $alumno->persona->sexo}}</td>
            <td>{{ $alumno->persona->fecha_nacimiento}}</td>
            <td>{{ date_diff(date_create($alumno->persona->fecha_nacimiento), date_create(now()))->format('%y')}}</td>

            <td>{{ $alumno->curp}}</td>
            <td>{{ $alumno->status}}</td>
            <td>{{ $alumno->fechaInscripcion}}</td>
            <td>{{ $alumno->grupo->nombre ?? 'No asignado'}}</td>
            <td>{{ $alumno->tutor->persona->nombre ?? 'No asignado'}}</td>

            <td>
                <form action="{{ route('alumnos.destroy',$alumno->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <a href="/alumnos/{{ $alumno->id }}/edit" class="btn btn-info">Editar</a>
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
        </tr>
        @empty
        <p>NO HAY DATOS PARA MOSTRAR</p>
    @endforelse
@endsection