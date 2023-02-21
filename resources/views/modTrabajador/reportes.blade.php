@extends('modTrabajador.plantillaNoSlidebar')

@section('title', 'Reportes')

@section('content_header')
    @if($trabajador->puesto=='ORIENTADOR')
        <h1 class="text-center">
            <span class="text-primary">
                <i class="fas fa-compass"></i>
            </span>
            Todos los reportes
        </h1>
    @else
        <h1 class="text-center">
            <span class="text-primary">
                <i class="fa fa-user-circle"></i>
            </span>
            Todos mis reportes
        </h1>
    @endif
    <p style="text-align: center;" class="fs-5">Sistema integral de información de la EST 52 ->
        <b>{{ $trabajador->persona->apellido_p }} {{ $trabajador->persona->apellido_m ?? '' }} {{ $trabajador->persona->nombre[0] }}.
        </b>
    </p>

    <div id="cajaMiniDashboardReportesIndex" data-trabajador-id="{{$trabajador->puesto}}">
        @include('modWidgets.miniCardsReportesIndex', ['reportes' => $reportes,'trabajador' => $trabajador])
    </div>

    @php
        $puesto=$trabajdor->puesto ?? 'desconocido'
    @endphp

    {{-- <div class="row g-3">
        <div class="col-md-4">
            <p class="fs-5"> {{ $trabajador->persona->apellido_p }} {{ $trabajador->persona->apellido_m ?? '' }} {{ $trabajador->persona->nombre[0] }}</p>
            @if($trabajador->puesto=='PREFECTO')
            <p class="fs-5">PREFECTURA</p>
            @endif
        </div>
        <div class="col-md-4">
            <p class="fs-2"> Todos los reportes</p>
        </div>  
        <div class="col-md-4">
            <div class="d-flex justify-content-end">
                <a href="/trabajador/{{ $trabajador->id }}" class="btn btn-warning">Regresar a la sección principal</a><br>
                <a href="{{ route('trabajador.reportes.completo',$trabajador->id) }}" class="btn btn-primary">Nuevo formato de reporte completo</a>
            </div>
        </div>  
    </div> --}}
@stop

@section('content')
    <div class="d-flex justify-content-center">
        <a href="/trabajador/{{ $trabajador->id }}" class="btn btn-warning">Regresar a la sección principal</a><br>
        <div class="m-1"></div>
        <a href="{{ route('trabajador.reportes.completo',$trabajador->id) }}" class="btn btn-primary">Nuevo formato de reporte completo</a>
    </div>
    <br>
    <div class="alert alert-info" role="alert">
        A continucación se muestran todos los reportes a los que tiene permiso. En la columna de Acciones dispone de todas las opciones de  este usuario
    </div>
    <div class="alert alert-warning" role="alert">
        Sólo puede borrar reportes  que haya hecho el mismo día, así como de visualizar solamente los reportes pertenecientes al  ciclo escolar vigente
    </div>
        
    <table id="tablaReportes" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Fecha de creación</th>
                <th scope="col">Alumno</th>
                <th scope="col">Asunto</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Puntaje</th>
                @if($trabajador->puesto== 'ORIENTADOR')
                    <th scope="col">Área</th>                     
                @endif
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reportes->sortByDesc('id'); as $reporte)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>
                        @if($trabajador->puesto=='PREFECTO')
                            {{ $reporte->fecha }}
                        @else
                            {{ $reporte->created_at }}
                        @endif
                    </td>
                    <td>{{ $reporte->alumno->persona->nombre}} {{ $reporte->alumno->persona->apellido_p }} {{ $reporte->alumno->persona->apellido_m ?? '' }}</td>
                    <td>{{ $reporte->asunto }}</td>
                    <td>{{ $reporte->observaciones }}</td>
                    <td>{{ $reporte->puntaje }}</td>
                    
                    @if($trabajador->puesto== 'ORIENTADOR')
                        <td>{{ $reporte->trabajador->puesto ?? 'OTRO' }}</td>
                    @endif
                    
                    <td>
                        @if($reporte->fecha == now()->toDateString())
                            <div class="">
                                <form action="{{ route('trabajador.reportes.destroy',$reporte->id) }}" method="POST" class="formularioEliminar">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('trabajador.reportes.actualizar', ['reporte_id' => $reporte->id, 'trabajador_id' => $trabajador->id]) }}" class="btn btn-info">Ver/Editar</a>
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                </form>
                            </div>
                        @else
                            {{-- <a href="{{ route('trabajador.reportes.actualizar',$reporte->id) }}" class="btn btn-warning">Editar</a> --}}
                            <a href="{{ route('trabajador.reportes.actualizar', ['reporte_id' => $reporte->id, 'trabajador_id' => $trabajador->id]) }}" class="btn btn-warning">Ver/Editar</a>
                        @endif
                        
                    </td>
                    
                </tr>
            @empty
                <p>NO HAY DATOS PARA MOSTRAR</p>
            @endforelse
        </tbody>
    </table>

@stop

@section('estilos')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@stop

@section('jscript')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>    

    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Todos los registros del reporte  han sido borrados del sistema',
                'success'
            )
        </script>
    @endif
        <script>
            $(document).ready(function () {
                $('#tablaReportes').DataTable();
                // Obtener el div por su ID
                var div = document.getElementById("cajaMiniDashboardReportesIndex");
                // Obtener el valor del atributo data-tutor-id del div
                var puesto = div.getAttribute("data-trabajador-id");
                if(puesto=='ORIENTADOR'){
                    document.querySelector('.main-sidebar').style.display = 'block';
                    document.querySelector('.main-header').style.marginLeft = '';
                    document.querySelector('.content-wrapper').style.marginLeft = '';
                    sidebar.style.display = 'block';
                }
            });



            $('#tablaReportes').DataTable( {
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

            $('.formularioEliminar').submit(function (evt) {
                evt.preventDefault(); 
                
                Swal.fire({
                title: '¿Desea eliminar el reporte?',
                text: "Se borrará de todos los registros del sistema",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí, eliminar reporte'
                }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
                })
            });

            $('#btn-solopendientes').click(function(){
                var table = $('#tablaReportes').DataTable();
                table.rows().every(function(rowIdx, tableLoop, rowLoop){
                    var data = this.data();
                    if(data[0] < 10){
                    this.nodes().to$().show();
                    }else{
                    this.nodes().to$().hide();
                    }
                });
            });

        </script>

        <script>
            function eliminarReporte(nombre){
                Swal.fire({
                    title: 'Está seguro?',
                    text: "Es posible que haya ocurrido un error en los datos, De ser así  favor de confirmar. Se eliminará de su registro a:"+nombre,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                })
            }
            
        </script>
@stop