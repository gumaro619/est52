<div class="row">
    <div class="col-md-3 col-sm-6 col-12" id="cardRep1" data-trabajador-id="{{$trabajador->id}}">
        <div class="info-box btnCardReportes">
            <span class="info-box-icon bg-danger">
                <i class="fas fa-clipboard-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Reportes del ciclo escolar</span>
                <span class="info-box-number">{{ $info['reportesCiclo'] ?? 'sin datos' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="cardRep2">
        <div class="info-box btnCardReportes">
            <span class="info-box-icon bg-warning">
                <i class="fas fa-dot-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Puntosde conducta Acumulados</span>
                <span class="info-box-number">{{ $info['puntos'] ?? 'sin datos' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="cardRep3">
        <div class="info-box btnCardReportes">
            <span class="info-box-icon bg-warning">
                <i class="fas fa-bullhorn"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Alumnos con 3 o más reportes</span>
                <span class="info-box-number">{{ $info['reincidentes'] ?? 'sin datos' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="cardRep4">
        @php
            $clase="btnBloqueado";
            if($trabajador->puesto=='COORDINADOR'){
                $clase="btnCardReportes";
            }
        @endphp
        <div class="info-box {{$clase}}">
            <span class="info-box-icon bg-dark">
                <i class="fas fa-database"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Todos los registros</span>
                <span class="info-box-number">{{ $info['reportes'] ?? 'sin datos' }}</span>
            </div>
        </div>
        
    </div>
</div>