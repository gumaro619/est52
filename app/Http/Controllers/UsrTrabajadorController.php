<?php

namespace App\Http\Controllers;
use App\Models\Trabajador;
use App\Models\Alumno;
use App\Models\Reporte;
use App\Models\Tutor;


use Illuminate\Http\Request;

class UsrTrabajadorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $trabajadores = Trabajador::select('*')
            ->where('puesto','<>','DOCENTE')
            ->get();
        return view('modTrabajador.index',compact('trabajadores'));
    }

    public function mostrarTrabajador($id){
        //buscamos el trabajador- pata mostrar su dashboard
        $trabajador=Trabajador::find($id);

        //ALUMNOS ES NECESARIO PARA EL SELECT2 ADEMAS QUE AMBOS TRABAJADORES PUEDEN BUSCAR EN TODOS LOS 
        //REGISTROS puesto a que  se adjuntan los datos mínimos
        $alumnos = Alumno::select('id','grupo_id','persona_id')
            ->get();

        if($trabajador->puesto=='PREFECTO'){
            return view('modTrabajador.prefectoHome',compact('trabajador','alumnos'));

        }elseif ($trabajador->puesto=='ORIENTADOR') {
            $numeroTutores = Tutor::select(\DB::raw('count(*) as numeroTutores'))
                ->first()->numeroTutores;
            $topReportes = Reporte::orderBy('created_at', 'desc')->take(7)->get();

            $info =[
                'alumnos' => count($alumnos),
                'tutores' => $numeroTutores,
                'activos' => Alumno::where('status', '=', 'activo')->count(),
                'suspendidos' => Alumno::where('status', '=', 'suspension')->count(),
                'otros'=> $alumnosInactivos = Alumno::where('status', '<>', 'activo')
                                                    ->where('status', '<>', 'suspension')
                                                    ->count(),
                'reportes' => Reporte::count(),
                'puntos' => Reporte::sum('puntaje'),
                'reincidentes' => Alumno::has('reportes', '>=', 3)->count(),
                // 'reincidentes' => \DB::table('alumno')
                //                 ->join('reporte', 'alumno.id', '=', 'reporte.alumno_id')
                //                 ->select('alumno.id', \DB::raw('count(reporte.id) as num_reportes'))
                //                 ->groupBy('alumno.id')
                //                 ->having('num_reportes', '>=', 3)
                //                 ->get(),
                'reportesCiclo' => Reporte::count(),
            ];
            return view('modTrabajador.orientadorHome',compact('trabajador','alumnos','info','topReportes'));
        }else{
            return 'puesto no reconocible, ud no cuenta con una cuenta en el sistema';
        }
    }

    public function reportar(Request $request){
        //reportes rápidos, GENERALMENTE EL PREFECTO ENTRA ACA
        $this->validar($request);

        if($request->idAlumnos==''){
            $this->validate($request, [
                'idAlumnos[]'=>'required'
            ],
            [   
                'idAlumnos[].required'=>'Atención no ha seleccionado ningún alumno'
            ]);
        }


        $idAlumnos=$request->idAlumnos;
        $ahora=now();
        foreach($idAlumnos as $id){
            $reporte=new Reporte();

            $reporte->puntaje=0;
            $reporte->observaciones='?';
            $reporte->asunto=$request->get('asunto');
            $reporte->fecha=$request->get('fecha');
            $reporte->alumno_id = $id;
            $reporte->trabajador_id = $request->get('trabajador_id');
            $reporte->created_at=$ahora;
            $reporte->updated_at=$ahora;

            $reporte->save();
        }    
        return redirect("/trabajador/".$request->get('trabajador_id'));
    }
    
    public function reportarCompleto(Request $request){
        //reportes rápidos, GENERALMENTE EL PREFECTO ENTRA ACA
        $this->validarFull($request);
        if($request->idAlumnos==''){
            $this->validate($request, [
                'idAlumnos[]'=>'required'
            ],
            [   
                'idAlumnos[].required'=>'Atención no ha seleccionado ningún alumno'
            ]);
        }


        $idAlumnos=$request->idAlumnos;
        $ahora=now();
        foreach($idAlumnos as $id){
            $reporte=new Reporte();

            $reporte->puntaje=$request->get('puntaje');
            $reporte->observaciones=$request->get('observaciones');
            $reporte->asunto=$request->get('asunto');
            $reporte->fecha=$request->get('fecha');
            $reporte->alumno_id = $id;
            $reporte->trabajador_id = $request->get('trabajador_id');
            $reporte->created_at=$ahora;
            $reporte->updated_at=$request->get('date');

            $reporte->save();
        }    
        return redirect("/trabajador/reportes/".$request->get('trabajador_id'));
    }



    //pertenecientes al trabajador_id
    public function mostrarReportes($id){
        //buscamos los reportes del trabajdor del trabajador

        
        $trabajador = Trabajador::find($id);
        if($trabajador->puesto=='ORIENTADOR'){
            $reportes = Reporte::all();
        }else{
            $reportes = Reporte::select('*')
            ->where('trabajador_id',$id)
            ->orderBy('fecha', 'desc')
            ->get();
        }
        //se busca enviar la lista de reportes que este trabajador ha hecho en caso de que sea prefecto
        //en caso de que sea orientador se le madnan todos los reportes del ciclo escolar
        return view('modTrabajador.reportes',compact('trabajador','reportes'));
    }

    public function formatoSimple($id){
        //SIMPLEMENTE ACTUALIZAMOS LA COLUMNA UPDATE NO TENDRA LA NOTIFICACIÓN, HACER ESTO GARANTIZA  PUNTOS =0 Y OBSERVACIÓN COMO LLAMADO DE ATENCIÓN
        //recibimos el id del reporte, ya que solo se envia desde una vista de usuario  si o si tiene  la columna- trbajador_id
        $reporte=Reporte::find($id);

        $reporte->observaciones='LLAMADO DE ATENCIÓN';
        $reporte->updated_at=now();
        $reporte->save();
        // PARA REGRESAR al panel prncipal
        $trabajador=$reporte->trabajador_id;
        return $this->mostrarTrabajador($trabajador);
    }

    public function formatoCompleto($id){
        $trabajador=Trabajador::find($id);
        
        $alumnos = Alumno::select('id','grupo_id','persona_id')
            ->get();
        return view('modTrabajador.reportesCrear',compact('trabajador','alumnos')); 

    }

    //es get pero lrvel lo puede maneja con Request
    public function updateReporte(Request $request){
        $reporteId = $request->query('reporte_id');
        $trabajadorId = $request->query('trabajador_id');
        
        $reporte=Reporte::find($reporteId);
        $trabajador=Trabajador::find($trabajadorId);

        return view('modTrabajador.reportesUpdate',compact('reporte','trabajador')); 
    }
    public function storeUpdateReporte(Request $request){
        $this->validarFull($request);

        $reporte=Reporte::find($request->get('reporte_id'));
        
        $reporte->puntaje=$request->get('puntaje');
        $reporte->observaciones=$request->get('observaciones');
        $reporte->asunto=$request->get('asunto');
        $reporte->fecha=$request->get('fecha');
        $reporte->alumno_id = $request->get('alumno_id');
        $reporte->trabajador_id = $request->get('trabajador_id');
        $reporte->updated_at=$request->get('date');
        $reporte->save();

        return redirect("/trabajador/".$request->get('trabajador_id'));
    }


    //vistas show
    public function mostrarAlumnos(Request $request){

        //buscamos los reportes del trabajdor del trabajador
        if($request->idAlumnos==''){
            $this->validate($request, [
                'idAlumnos[]'=>'required'
            ],
            [   
                'idAlumnos[].required'=>'Atención no ha seleccionado ningún alumno'
            ]);
        }

        $idAlumnos=$request->idAlumnos;
        $alumnos=Alumno::find($idAlumnos);
        $trabajador=Trabajador::find($request->get('trabajador_id'));
        return view('modTrabajador.mostrarAlumnos',compact('alumnos','trabajador')); 
    }

    //vistas Alumnos en forma de lista GET CON REQUEST
    public function listarAlumnos(Request $request){
        //el id del trabajador sigue siendo ahuivi
        $trabajadorId = $request->query('trabajador_id');
        //preguntamos cuantos parametrso se han enviado a traves del request
        $trabajador=Trabajador::find($trabajadorId);
        if(count($request->all())==1){
            $alumnos= Alumno::select('*')
            ->get();
            return view('modTrabajador.listaAlumnos',compact('alumnos','trabajador')); 
        }
        
    }


    //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
    public function validar(Request $request)
    {
        $this->validate($request, [
            'fecha'=>'required|date',
            'asunto'=>'required'
        ],
        [   
            'fecha.required'=>'La fecha es obligatoria',
            'asunto.required'=>'Debe  indicar  el asunto, por más minima que sea la descripción, El asunto por defecto se coloca en PENDIENTE,',
            'puntaje.required_if'=>'El puntaje es obligatorio si desea hacer un reporte completo',
            'observaciones.required_if'=>'Debe incluir una breve descripción del contexto del reporte'
        ]);
    }

    public function validarFull(Request $request)
    {
        $this->validate($request, [
            'fecha'=>'required|date',
            'asunto'=>'required',
            'puntaje'=>'required|numeric|between:0,10',
            'observaciones'=>'required'
        ],
        [   
            'fecha.required'=>'La fecha es obligatoria',
            'asunto.required'=>'Debe  indicar  el asunto, por más minima que sea la descripción, El asunto por defecto se coloca en PENDIENTE,',
            'puntaje.required'=>'El puntaje es obligatorio si desea hacer un reporte completo',
            'observaciones.required'=>'Debe incluir una breve descripción del contexto del reporte'
        ]);
    }

    //FUNCIÓN delete ELIMINAR REPORTES
    public function destroy($id)
    {
        //Reporte::find($id)->delete();
        $reporte=Reporte::find($id);
        $idTrabajador=$reporte->trabajador_id;

        $reporte->delete();
        return redirect('/trabajador/reportes/'.$idTrabajador)->with('eliminar','ok');
    }
}
