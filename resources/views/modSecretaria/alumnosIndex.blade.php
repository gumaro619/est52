@extends('vistasPersona.formularioIndexPersona')

@section('header')
    <p>SECRETARIAS -> ALUMNOS </p>
@endsection

@section('bodi')
    <a href="/secretarias" class="btn btn-primary">Volver al dashboard</a>
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
    <th scope="col">GRADO</th>
    <th scope="col">TUTOR</th>
    <th scope="col">Acciones</th>
@endsection

@section('filasTBody')
    @forelse($alumnos as $alumno)
        <tr>
            <td>{{ $alumno->persona->id }}</td>
            <td>{{ $alumno->persona->nombre}}</td>
            <td>{{ $alumno->persona->apellido_p}}</td>
            <td>{{ $alumno->persona->apellido_m}}</td>
            <td>{{ $alumno->persona->sexo}}</td>
            <td>{{ $alumno->persona->fecha_nacimiento}}</td>
            <td>{{ date_diff(date_create($alumno->persona->fecha_nacimiento), date_create(now()))->format('%y')}}</td>

            <td>{{ $alumno->curp}}</td>
            <td>{{ $alumno->status}}</td>
            <td>{{ $alumno->fechaInscripcion}}</td>
            <td>{{ $alumno->grado}}</td>
            <td>{{ $alumno->tutor->persona->nombre ?? 'No asignado'}}</td>

            <td>
                <a href="/alumnos/{{ $alumno->id }}/edit" class="btn btn-info">Editar</a>
            </td>
        </tr>
        @empty
        <p>NO HAY DATOS PARA MOSTRAR</p>
    @endforelse
@endsection