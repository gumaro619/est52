
<div class="row">
    <div class="col-md-3 col-sm-6 col-12" id="cardRep1" data-alumno-id="{{$alumno->id}}">
        <div class="info-box btnCardReportes">
            <span class="info-box-icon bg-secondary">
                <i class="fas fa-clipboard-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Reportes del ciclo escolar</span>
                <span class="info-box-number">{{ $alumno->reportes->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="cardRep2">
        <div class="info-box btnCardReportes">
            <span class="info-box-icon bg-secondary">
                <i class="fas fa-dot-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Puntosde conducta Acumulados</span>
                <span class="info-box-number">{{ $alumno->reportes->sum('puntaje') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="cardRep3">
        <div class="info-box btnCardReportes">
            <span class="info-box-icon bg-secondary">
                <i class="fas fa-circle-notch"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Calificaciones registradas</span>
                <span class="info-box-number">{{ $alumno->calificaciones->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="cardRep4">
        @php
            
        @endphp
        @php
            try {
                $calificaciones=$alumno->calificaciones->count();
                $sumatoria=$alumno->calificaciones->sum('calificacion');
                $promedio=$sumatoria/$calificaciones;
            } catch (Throwable $e) {
                $promedio='Datos insuficientes';
            }
        @endphp
        <div class="info-box">
            <span class="info-box-icon bg-secondary">
                <i class="fas fa-plus-circle"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Promedio total parcial</span>
                <span class="info-box-number">{{ $promedio}}</span>
            </div>
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <div class="card card-ligth">
            {{-- ------------------------------HEADER --}}
            <div class="card-header" style="background-color: antiquewhite">
                <div class="d-flex justify-content-center">
                    <strong>Datos del Estudiante</strong>
                </div>
            </div>
        
            {{-- ------------------------------BODY --}}
            <div class="card-body">
                <div class="mb-3 border p-2 mb-2 border-opacity-75">
                    <div class="form-check form-check-inline">
                        <label for="" class="form-label">Nombre(s): </label>
                        <input type="text" class="form-control" value="{{ $alumno->persona->nombre }}" disabled>
                    </div>
                    <div class="form-check form-check-inline">
                        <label for="" class="form-label">Primer Apellido : </label>
                        <input type="text" class="form-control" value="{{ $alumno->persona->apellido_p }}" disabled>
                    </div>
                    <div class="form-check form-check-inline">
                        <label for="" class="form-label">Segundo Apellido: </label>
                        <input type="text" class="form-control" value="{{ $alumno->persona->apellido_m }}" disabled>
                    </div>
                    <div class="form-check form-check-inline">
                        <label for="" class="form-label">Sexo: </label>
                        <div class="form-check">
                            <input readonly type="radio" class="form-check-input" @if($alumno->persona->sexo=='M')
                                                                            checked
                                                                        @endif name="sexo{{ $alumno->id }}" id="m{{ $alumno->id }}" readonly>
                            <label class="form-check-label" for="masculinoTutor" >Masculino</label>
                        </div>
                        <div class="form-check mb-3" aria-readonly="true">
                            <input readonly type="radio" class="form-check-input" @if($alumno->persona->sexo=='F')
                                                                            checked
                                                                        @endif name="sexo{{ $alumno->id }}" id="f{{ $alumno->id }}" readonly>
                            <label class="form-check-label" for="femeninoTutor">Femenino</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <label for="" class="form-label">Fecha de nacimiento: </label>
                        <input type="text" class="form-control" value="{{ $alumno->persona->fecha_nacimiento }}" disabled>
                    </div>
                    <div class="form-check form-check-inline">
                        <label for="" class="form-label">Edad actual: </label>
                        <input type="text" class="form-control" value="{{ date_diff(date_create($alumno->persona->fecha_nacimiento), date_create(now()))->format('%y años %m meses y %d días ')}}" style="width: 200px;" disabled>
                    </div>
                </div>
            </div>
            {{-- ------------------------------FOOTER --}}
            <div class="card-footer">
                <div class="mb-3 border p-2 mb-2 border-opacity-75">
                    <div class="form-group form-check form-check-inline">
                        <label>CURP:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-signature"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control"
                            value="{{ $alumno->curp }}" disabled>
                        </div>
                    </div>
                    <div class="form-group form-check form-check-inline">
                        <label>Fecha de inscripción:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" 
                            value="{{ $alumno->created_at ?? $alumno->fechaInscripcion }}" disabled>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div id="main">
                            <p class="fs-7"><strong>Status->  </strong>  {{ $alumno->status }}</p>
                            <label class="mycheckbox">
                                <input type="checkbox" name="boxes[{{ $alumno->id }}]" id="boxes[{{ $alumno->id }}]" @if ($alumno->status=='activo')
                                    checked
                                @endif disabled>
                                <span>
                                    <i class="fas fa-check on"></i>
                                    <i class="fas fa-times off"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group form-check form-check-inline">
                        <label>MATRÍCULA:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                </span>
                            </div>
                            @php
                                $fechaInscripcion = substr($alumno->fechaInscripcion,2,2);
                                $iniciales = $alumno->persona->apellido_p[0].$alumno->persona->apellido_m[0].$alumno->persona->nombre[0].substr($alumno->persona->nombre, -1);
                                $iniciales=strtoupper($iniciales);
                                //ultimos 2 dígitos del id, agregar el 0 si es menor a 10
                                $id=str_pad(substr($alumno->id, -2), 2, '0', STR_PAD_LEFT);
                                
                                $matricula = $fechaInscripcion.$iniciales."-".$id;
                            @endphp
                            <input type="text" class="form-control" value="{{ $matricula }}" disabled>
                        </div>
                    </div>
                    <div class="form-group form-check form-check-inline">
                        <label>Grupo actual:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-users"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{ $alumno->grupo->nombre }}" style="width: 100px;" disabled>
                        </div>
                    </div>
                    <div class="form-group form-check form-check-inline">
                        <label>Clases Enlistadas :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{ $alumno->grupo->clases->count() ?? '0' }}" style="width: 100px;" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Materias :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-book"></i>
                                    </span>
                                </div>
                                @php
                                    $horarios = array();
                                    $strClases='';
                                    foreach ($alumno->grupo->clases->sortBy('horaE') as $clase) {
                                        $strClases=$strClases."- ".$clase->materia->nombre." ";
                                        $horarios[]=$clase->horaE;
                                    }
                                @endphp
                                <input type="text" class="form-control" value="{{$strClases}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
        {{-- SEPARADOR DE COLUMNA --}}
    <div class="col-md-6">
        <div class="card card-ligth">
            {{-- ------------------------------HEADER --}}
            <div class="card-header border-primary" style="background-color: rgb(91, 106, 91);color:whitesmoke">
                <div class="d-flex justify-content-center">
                    <strong>Datos del tutor</strong>
                </div>
            </div>
        
            {{-- ------------------------------BODY --}}
            @if($alumno->tutor)
                <div class="card-body">
                    <div class="mb-3 border p-2 mb-2 border-opacity-75">
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Nombre(s): </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->persona->nombre }}" disabled>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Primer Apellido : </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->persona->apellido_p }}" disabled>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Segundo Apellido: </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->persona->apellido_m }}" disabled>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Sexo: </label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" @if($alumno->tutor->persona->sexo=='M')
                                                                                checked
                                                                            @endif name="sexo{{ $alumno->tutor->id }}" id="m{{ $alumno->tutor->id }}" readonly>
                                <label class="form-check-label" for="masculinoTutor" >Masculino</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="radio" class="form-check-input" @if($alumno->tutor->persona->sexo=='F')
                                                                                checked
                                                                            @endif name="sexo{{ $alumno->tutor->id }}" id="f{{ $alumno->tutor->id }}" readonly>
                                <label class="form-check-label" for="femeninoTutor">Femenino</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Fecha de nacimiento: </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->persona->fecha_nacimiento }}" disabled>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Edad actual: </label>
                            <input type="text" class="form-control" value="{{ date_diff(date_create($alumno->tutor->persona->fecha_nacimiento), date_create(now()))->format('%y años %m meses y %d días ')}}" style="width: 200px;" disabled>
                        </div>
                    </div>
                </div>
                        {{-- ------------------------------footer --}}
                <div class="card-footer">
                    <div class="mb-3 border p-2 mb-2 border-opacity-75">
                        <div class="form-group form-check form-check-inline">
                            <label>Teléfono Principal:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                    <input type="text" class="form-control"  style="width: 130px;"
                                    value="({{ substr($alumno->tutor->telefono_1,0,3) }}) {{ substr($alumno->tutor->telefono_1,2,7) }}" disabled>
                            </div>
                        </div>
                        <div class="form-group form-check form-check-inline">
                            <label>Teléfono Secundario:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                    <input type="text" class="form-control" style="width: 130px;" 
                                    value="({{ substr($alumno->tutor->telefono_2,0,3) }}) {{ substr($alumno->tutor->telefono_2,2,7) }}" disabled>
                            </div>
                        </div>
                        <div class="form-group form-check form-check-inline">
                            <label>Correo electrónico:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></i></span>
                                </div>
                                    <input type="text" class="form-control"  value="{{ $alumno->tutor->correo ?? 'Sin registro' }}" disabled>
                            </div>
                        </div>
                        <div class="form-group form-check form-check-inline">
                            <label>Dir:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Estado: </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->estado }}" disabled>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Municipio: </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->municipio }}" disabled>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Colonia: </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->colonia }}" disabled>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-label">Calle: </label>
                            <input type="text" class="form-control" value="{{ $alumno->tutor->calle }}" disabled>
                        </div>
                        <div class="form-group form-check form-check-inline">
                            <label>Número:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">#</span>
                                </div>
                                    <input type="text" class="form-control"  style="width: 130px;"
                                    value="{{ $alumno->tutor->numero ?? 'S/N' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Este Alumno no tiene TUTOR registrado¡
                </div> 
            @endif



            
            
                
        </div>
    </div>
</div>

<div class="row">
    <div class="card card-ligth">
        {{-- ------------------------------HEADER --}}
        <div class="card-header" >
            <div class="d-flex justify-content-center">
                <p class="fs-5"><i class="fas fa-hourglass"></i> Horario de clases de {{ $alumno->persona->nombre }}</p>
            </div>
        </div>
    
        {{-- ------------------------------BODY --}}
        <div class="card">
            <table id="tablaHorario" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead style="background-color: rgb(221, 232, 255)">
                    <tr>
                        <th scope="col" style="border: 1px solid rgb(105, 105, 105);">Hora/Día</th>
                        <th scope="col" style="border: 1px solid rgb(105, 105, 105);"><div class="d-flex justify-content-center">LUNES</div></th>
                        <th scope="col" style="border: 1px solid rgb(105, 105, 105);"><div class="d-flex justify-content-center">MARTES</div></th>
                        <th scope="col" style="border: 1px solid rgb(105, 105, 105);"><div class="d-flex justify-content-center">MIERCOLES</div></th>
                        <th scope="col" style="border: 1px solid rgb(105, 105, 105);"><div class="d-flex justify-content-center">JUEVES</div></th>
                        <th scope="col" style="border: 1px solid rgb(105, 105, 105);"><div class="d-flex justify-content-center">VIERNES</div></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alumno->grupo->clases->sortBy('horaE') as $clase)
                    <tr>
                        <td>{{ substr($clase->horaE, 0, 5)." a ".substr($clase->horaS, 0, 5) }}</td>
                        <td>@if(str_contains($clase->dias, "L"))
                            <div class="d-flex justify-content-center">
                                <p>{{ $clase->materia->nombre }}</p>
                            </div>
                            @endif</td>
                        <td>@if(str_contains($clase->dias, "M"))
                            <div class="d-flex justify-content-center">
                                <p>{{ $clase->materia->nombre }}</p>
                            </div>
                            @endif</td>
                        <td>@if(str_contains($clase->dias, "W"))
                            <div class="d-flex justify-content-center">
                                <p>{{ $clase->materia->nombre }}</p>
                            </div>
                            @endif</td>
                        <td>@if(str_contains($clase->dias, "J"))
                            <div class="d-flex justify-content-center">
                                <p>{{ $clase->materia->nombre }}</p>
                            </div>
                            @endif</td>
                        <td>@if(str_contains($clase->dias, "V"))
                            <div class="d-flex justify-content-center">
                                <p>{{ $clase->materia->nombre }}</p>
                            </div>
                            @endif</td>
                    </tr>
                    @if($clase->horaS=='09:30:00'||$clase->horaS=='12:30:00')
                    <tr style="background-color: rgb(228, 239, 255)">
                        <td style="text-align: center;">R</td>
                        <td style="text-align: center;">E</td>
                        <td style="text-align: center;">C</td>
                        <td style="text-align: center;">E</td>
                        <td style="text-align: center;">S</td>
                        <td style="text-align: center;">O</td>
                    </tr>
                    @endif
                    @empty
                    <p class="fs-4"> Al parecer no hay clases asignadas aún</p>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- ------------------------------FOOTER --}}
    </div>
</div>