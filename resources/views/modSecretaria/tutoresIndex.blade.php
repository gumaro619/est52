@extends('vistasPersona.formularioIndexPersona')

@section('header')
    <p>SECRETARIAS -> TUTORES </p>
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

    <th scope="col">TEL 1</th>
    <th scope="col">TEL 2</th>
    <th scope="col">EMAIL</th>
    <th scope="col">ESTADO</th>
    <th scope="col">MUNICIPIO</th>
    <th scope="col">COL.</th>
    <th scope="col">CALLE</th>
    <th scope="col">NUM</th>
    <th scope="col">Acciones</th>
@endsection

@section('filasTBody')
    @forelse($tutores as $tutor)
        <tr>
            <td>{{ $tutor->persona->id }}</td>
            <td>{{ $tutor->persona->nombre}}</td>
            <td>{{ $tutor->persona->apellido_p}}</td>
            <td>{{ $tutor->persona->apellido_m}}</td>
            <td>{{ $tutor->persona->sexo}}</td>
            <td>{{ $tutor->persona->fecha_nacimiento}}</td>

            <td>{{ $tutor->telefono_1}}</td>
            <td>{{ $tutor->telefono_2}}</td>
            <td>{{ $tutor->correo}}</td>
            <td>{{ $tutor->estado}}</td>
            <td>{{ $tutor->municipio}}</td>
            <td>{{ $tutor->colonia}}</td>
            <td>{{ $tutor->calle}}</td>
            <td>{{ $tutor->numero}}</td>

            <td>
                <a href="/tutores/{{ $tutor->id }}/edit" class="btn btn-info">Editar</a>
            </td>
        </tr>
        @empty
        <p>NO HAY DATOS PARA MOSTRAR</p>
    @endforelse
@endsection