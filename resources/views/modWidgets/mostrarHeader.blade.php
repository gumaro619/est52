<div id="cajaHeader">
    @if($trabajador->puesto=='ORIENTADOR')
        <h1 class="text-center" id="titulo">
            <span class="text-primary">
                <i class="fas fa-compass"></i>
            </span>
            Todos los Alumnos
        </h1>
    @else
        <h1 class="text-center" id="titulo">
            <span class="text-primary">
                <i class="fa fa-user-circle"></i>
            </span>
            Todos mis Alumnos
        </h1>
    @endif
    <p style="text-align: center;" class="fs-5">Sistema integral de información de la EST 52 ->
        <b>{{ $trabajador->persona->apellido_p }} {{ $trabajador->persona->apellido_m ?? '' }} {{ $trabajador->persona->nombre[0] }}.</b>
    </p>

    <div class="" id="cajaBotonesHead">
        <div>
            <a href="{{ route('trabajador.mostrar',$trabajador->id) }}" class="btn btn-outline-primary btn-lg btn-icon-left"><i class="fas fa-home"></i> Regresar al Dashboard</a>
        </div>
    </div>
</div>