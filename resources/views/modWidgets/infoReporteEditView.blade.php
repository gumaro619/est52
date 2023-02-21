<div class="row">
    {{-- estas cards se muestran para ver o editar un reporte, info rel reporte recibe $reporte --}}
    {{-- primero determinamos el área --}}
    @php
        $area='otro';
        if($reporte->trabajador->puesto=='PREFECTO'){
            $area='Prefectura';
        }elseif ($reporte->trabajador->puesto=='ORIENTADOR') {
            $area='Orientación Ac.';
        }elseif ($reporte->trabajador->puesto=='DOCENTE') {
            $area='Docencia';
        }
    @endphp
    <div class="col-md-3 col-sm-6 col-12" id="card1">
        <div class="info-box" style="background-color: rgb(225, 225, 225)">
            <span class="info-box-icon bg-primary">
                <i class="fas fa-user"></i>
            </span>
            <div class="info-box-content">
                <div class="d-flex justify-content-center bg-primary">
                    <span class="info-box-number">Área:</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-5">
                        <span class="info-box-number">{{ $area }}</span>
                    </div>
                    <div class="col-md-7">
                        <span class="info-box-text">{{ $reporte->trabajador->persona->apellido_p }} {{ $reporte->trabajador->persona->apellido_m ?? '' }} {{ $reporte->trabajador->persona->nombre[0] }}</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="card2">
        <div class="info-box" style="background-color: rgb(225, 225, 225)">
            <span class="info-box-icon bg-dark">
                <i class="fas fa-plus-circle"></i></i>
            </span>
            <div class="info-box-content">
                <div class="d-flex justify-content-center bg-dark">
                    <span class="info-box-number">Creación (Fecha/Hora)</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-12 text-center">
                        <span class="info-box-number">{{ $reporte->created_at ?? 'sin datos' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="card3">
        <div class="info-box" style="background-color: rgb(225, 225, 225)">
            <span class="info-box-icon bg-dark">
                <i class="fas fa-sync"></i>
            </span>
            <div class="info-box-content">
                <div class="d-flex justify-content-center bg-dark">
                    <span class="info-box-number">Últ. actualización (Fecha/Hora)</span>
                </div>
                <div class="row -g3">
                    <div class="col-md-12 text-center">
                        <span class="info-box-number">{{ $reporte->updated_at ?? 'sin datos' }}</span>
                    </div>
                </div>
                <span class="info-box-number"></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12" id="card4">
        <div class="row g-3">
            <div class="col-md-6">
                {{-- btns clase para identificar a los botones --}}
                <div class="info-box btns" id="btnVer">
                    <span class="info-box-icon bg-success">
                        <i class="fas fa-eye"></i>
                    </span>
                    <div class="info-box-content text-center">
                        <span style="color: rgb(60, 133, 193);font-weight: bold;">VER</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box btns" id="btnEditar">
                    <span class="info-box-icon bg-info">
                        <i class="fas fa-edit"></i>
                    </span>
                    <div class="info-box-content text-center">
                        <span class="info-box-text"><span style="color: rgb(60, 133, 193);font-weight: bold;">EDITAR</span></span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>