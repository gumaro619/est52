<div class="mi-clase">
    <form action="{{ route('trabajador.reportar') }}" method="POST">
        @csrf
        <!--  datos ocultos  -->
        <input type="hidden" class="form-control" name="trabajador_id" id="trabajador_id" value="{{ $trabajador->id }}" >


        <div class="alert alert-info" role="alert">
            Ingrese rápidamente  el nombre(s), apellidos y/o grupo  para seleccionar a un alumno, puede seleccionar uno o varios alumnos aantes de enviar el formulario
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-md-6" style="background-color: rgb(255, 231, 224)">
                <div class="d-flex justify-content-center">
                    <select class="js-example-basic-multiple form-select form-select-lg mb-3" aria-label=".form-select-lg example" multiple="multiple" name="idAlumnos[]"> 
                        @foreach($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" @if(is_array(old('idAlumnos')) && in_array($alumno->id.'',old('idAlumnos')))
                                selected
                            @endif>
                                {{ $alumno->persona->nombre }} {{ $alumno->persona->apellido_p }} {{ $alumno->persona->apellido_m ?? '' }} - {{ $alumno->grupo->nombre ?? '(sin grupo)' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @error('idAlumnos[]')
            <p class="errores">*{{ $message }}</p>
            <br>
        @enderror
        <div class="d-flex justify-content-center">
            <div class="col-md-6">
                <label for="" class="form-label">Asunto : </label>
                <input type="text" class="form-control" name="asunto" id="asunto" value="{{ old('asunto','PENDIENTE') }}" placeholder="Indique el asunto del reporte" >
                @error('asunto')
                    <p class="errores">*{{ $message }}</p>
                    <br>
                @enderror
            </div>  
            <div class="col-md-6">
                <label for="" class="form-label">Fecha (hoy): </label>
                <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha',now()->toDateString()) }}" >
                @error('fecha')
                    <p class="errores">*{{ $message }}</p>
                    <br>
                @enderror
            </div>        
        </div>
        <br>
    
        <br>
        <div class="row">
            <div class="col-md-6">
                <div id="btns" class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning btn-lg" tabindex="">Generar reporte rápido</button>
                </div>
            </div>
            <div class="col-md-6">
                <div id="btns" class="d-flex justify-content-center">
                    <button class="btn btn-primary btn-lg" type="submit" formaction="{{ route('trabajador.alumnos') }}">Visualizar información</button>
                </div>
            </div>
        </div>
        <br>
        <div class="alert alert-primary" role="alert">
            Puede crear el formato rápido de reportes para editarlos dspués, en on su defecto buscar toda la infomración relevante de los alumnos seleccionados
        </div>
        
    </form>
</div>
