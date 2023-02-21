<div class="row">
    {{-- estas cards se muestran al  listar todos los reportes del trabajador --}}
    <div class="col-md-3 col-sm-6 col-12" id="card1">
        <div class="info-box">
            <span class="info-box-icon bg-danger">
                <i class="fas fa-clipboard-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total de registros:</span>
                <span class="info-box-number">{{ count($reportes) }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="card2">
        <div class="info-box">
            <span class="info-box-icon bg-warning">
                <i class="fas fa-hourglass-half"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Con asunto 'PENDIENTE'</span>
                <span class="info-box-number">{{ $reportes->where('asunto', 'PENDIENTE')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="card3">
        <div class="info-box">
            <span class="info-box-icon bg-primary">
                <i class="far fa-comment"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Sin Observaciones</span>
                <span class="info-box-number">{{ $reportes->whereIn('observaciones', ['?', '', null])->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="card4">
        <div class="info-box">
            <span class="info-box-icon bg-danger">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Casos graves <span style="color: red;font-weight: bold;">(>= 5 puntos)</span> </span>
                <span class="info-box-number">{{ $reportes->where('puntaje', '>=', 5)->count() }}</span>
            </div>
        </div>
    </div>
</div>