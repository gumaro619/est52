@extends('vistasPersona.formularioEditPersona')

@section('header')
    <h1>EDITAR ALUMNO</h1>
    <p>DATOS GENERALES DEL ALUMNO</p>
@endsection

@section('actionPOST')
    /alumnos/{{ $persona->alumno->id}}
@endsection

@section('inputsFormulario')
    <p>DATOS DE CONTACTO PARA EMERGENCIAS</p>

    <div class="mb-3">
        <label for="" class="form-label">CURP: </label>
        <input type="text" class="form-control" name="curp" id="curp" value="{{ old('curp',$persona->alumno->curp) }}">
        @error('curp')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Status: </label>
        <input type="text" class="form-control" id="status" name="status" value="{{ old('status',$persona->alumno->status) }}">
        @error('status')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Fecha inscripcion: </label>
        <input type="date" class="form-control" id="fechaInscripcion" name="fechaInscripcion" value="{{ old('fechaInscripcion',$persona->alumno->fechaInscripcion) }}">
        @error('fechaInscripcion')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Grado: </label>
        <input type="text" class="form-control" id="grado" name="grado" value="{{  old('grado',$persona->alumno->grado) }}">
        @error('grado')
                <small class="errores" >*{{ $message }}</small>
                <br>
        @enderror
    </div>

    <label class="form-label">Grado: </label>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="primero" name="grado" value="1" {{ old('grado') == '1' ? 'checked' : '' }}>
        <label class="form-check-label" for="primero">1° Primero</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="segundo" name="grado" value="2" {{ old('grado') == '2' ? 'checked' : '' }}>
        <label class="form-check-label" for="segundo">2° Segundo</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="tercero" name="grado" value="3" {{ old('grado') == '3' ? 'checked' : '' }}>
        <label class="form-check-label" for="tercero">3° Tercero</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="cuarto" name="grado" value="4" {{ old('grado') == '4' ? 'checked' : '' }}>
        <label class="form-check-label" for="cuarto">4° Cuarto</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="quinto" name="grado" value="5" {{ old('grado') == '5' ? 'checked' : '' }}>
        <label class="form-check-label" for="quinto">5° Quinto</label>
    </div>
    <div class="form-check mb-3">
        <input type="radio" class="form-check-input" id="sexto" name="grado" value="6" {{ old('grado') == '6' ? 'checked' : '' }}>
        <label class="form-check-label" for="sexto">6° Sexto</label>
        <div class="invalid-feedback">Debe seleccionar el grado</div>
    </div>
    @error('grado')
        <small class="errores">*{{ $message }}</small>
        <br>
    @enderror
    <br>21
    
    <div class="mb-3">
        <label for="" class="form-label">Tutor: </label>
        <div id="nombre" class="form-text">Seleccione un tutor de la lista, use el apartado de búsqueda para agilizar la tarea</div>
    </div>

    <table id="tablaTutores" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDO P.</th>
                <th scope="col">APELLIDO M.</th>
                <th scope="col">TEL 1</th>
                <th scope="col">EMAIL</th>
                <th scope="col">COL.</th>
                <th scope="col">Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tutores as $tutor)
                <tr>
                    <td>{{ $tutor->id}}</td>
                    <td>{{ $tutor->persona->nombre}}</td>
                    <td>{{ $tutor->persona->apellido_p}}</td>
                    <td>{{ $tutor->persona->apellido_m}}</td>
                    <td>{{ $tutor->telefono_1}}</td>
                    <td>{{ $tutor->correo}}</td>
                    <td>{{ $tutor->colonia}}</td>

                    <td>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="{{ $tutor->id }}°" name="tutor_id" value="{{ $tutor->id }}" 
                                @checked(old('tutor_id', ($persona->alumno->tutor->id ?? '')==$tutor->id))>
                            <label class="form-check-label" for="{{ $tutor->id }}°"> </label>
                        </div>
                    </td>
                </tr>
                @empty
                <p>NO HAY DATOS PARA MOSTRAR</p>
            @endforelse
        </tbody>
    </table>  
    @error('tutor_id')
        <small class="errores">*{{ $message }}</small>
        <br>
    @enderror
    <br>


    <div class="mb-3">
        <label for="" class="form-label">Grupo: </label>
        <div id="nombre" class="form-text">Seleccione un grup de la lista, use el apartado de búsqueda para agilizar la tarea</div>
    </div>
    <table id="tablaGrupos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">GRUPO</th>
                <th scope="col">CICLO ESCOLAR</th>
                <th scope="col">Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->id}}</td>
                    <td>{{ $grupo->nombre}}</td>
                    <td>{{ $grupo->ciclo}}</td>

                    <td>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="{{ $grupo->id }}°" name="grupo_id" value="{{ $grupo->id }}" 
                                @checked(old('grupo_id', ($persona->alumno->grupo->id ?? '')==$grupo->id))>
                            <label class="form-check-label" for="{{ $grupo->id }}°"> </label>
                        </div>
                    </td>
                </tr>
                @empty
                <p>NO HAY DATOS PARA MOSTRAR</p>
            @endforelse
        </tbody>
    </table>  
    @error('grupo_id')
        <small class="errores">*{{ $message }}</small>
        <br>
    @enderror
    <br>

@endsection

@section('hrefCancelar')
    /alumnos
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        .errores{
            color: rgb(173, 14, 14);
        }
    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaTutores').DataTable();
            $('#tablaGrupos').DataTable();
        });

        $('#tablaTutores,#tablaGrupos').DataTable( {
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
@endsection