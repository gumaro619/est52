<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Clase;
use App\Models\Reporte;
use App\Models\Trabajador;
use Illuminate\Support\Facades\DB;

class UsrDocenteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $docentes=Docente::all();
        return view('modDocente.serviciosDocente',compact('docentes'));
    }

    public function dashboard($id){
        $docente=Docente::find($id);
        $grupos=Grupo::all();
        return view('modDocente.dashboard',compact('grupos','docente'));
    }

    public function calificaciones(){
        $clases=Clase::all();
        return view('modDocente.calificaciones',compact('clases'));
    }

    public function reportes($id){
        $docente=Docente::find($id);
        //solo alumnos pertenecientes a este docente pendeitebn
        $alumnos=Alumno::all();
        return view('modDocente.reportes',compact('alumnos','docente'));
    }

    public function reportar(Request $request){
        $this->validarReportes($request);
        
        $reporte=new Reporte();

        $reporte->puntaje=$request->get('puntaje');
        $reporte->asunto=$request->get('asunto');
        $reporte->observaciones=$request->get('observaciones');
        $reporte->fecha=$request->get('fecha');
        $reporte->alumno_id = $request->get('alumno_id');
        $reporte->trabajador_id = $request->get('trabajador_id');

        $reporte->save();
        //$alumnos=Alumno::all();
        //$docente=Docente::find(Trabajador::find($reporte->trabajador_id)->id);
        //return view('modDocente.reportes',compact('alumnos','docente'));

        return redirect('/docente/reportes/'.$request->get('docente_id'));
    }

    public function sqls($id){
        //saber si todos los alumnos de una clase  tienene todas las calificaciones
        //todas las calificaciones parciales con sus faltas de un  arreglo de pertenecientes a una clase clase
        //nombre    calificacion1 faltas1 cal2 faltas2 cal3 faltas3 clase
        //
        //
        //

    }

    public function calificarClase($id){

        $clase =Clase::find($id);
        $periodo = '0';
        return view('modDocente.calificarClase',compact('clase','periodo'));
    }


    public function preStoreCalificaciones(Request $request){
        $clase_id=$request->get('clase_id_inf');
        $periodo=$request->get('clase_periodo_inf');

        $clase =Clase::find($clase_id);
        return view('modDocente.calificarClase',compact('clase','periodo'));

        //consulta: $alumnos= todos los alumnos que tengan la clase: clase_id
        //$alumnos = Alumno::select('id', 'status','persona_id','grupo_id')
        //    ->where('grupo_id', $clase->grupo->id)
        //    ->orderBy('id', 'desc')
        //    ->get();
        //ordenar alumnos por apellido_id
        //todas las calificaciones del periodo $periodo de todos los alumnos en $alumnos en el mismo orden
        //id    nombre  apellidos   status  calificacioon faltas examenR 
        //1     a       a s d       a       9                 1     no
        //2     b       b   b       a       null               null     null
        //3
        //4
        //si no existe la calificación de ese alumno  null
    
    }

    public function storeCalificaciones(Request $request){

        $vacio=false;
        
        foreach ($request->calificacion as $cal) {
            if($cal==null){
                $vacio=true;
            }
        }



        $periodo=$request->get('periodo');
        $clase_id=$request->get('clase_id');

        //arreglos
        $examenR=$request->hizoExamen;;
        $calificacion=$request->calificacion;
        $faltas=$request->faltas;
        $alumno_id=$request->alumno_id;

        $clase =Clase::find($clase_id);
        $alumnos = Alumno::select('id', 'status','persona_id','grupo_id')->where('grupo_id', $clase->grupo->id)->orderBy('id', 'desc')->get();


        foreach ($alumnos as $alumno) {
            if($calificacion[$alumno->id]!==null && $faltas[$alumno->id]!==null){
                
                $registro=$alumno->calificaciones->where('periodo',$periodo)->where('clase_id',$clase_id)->first();
                if($registro){
                    //solo si cambia un dato reelevante  se actualiza WTFF
                    if (strval($registro->examenR) !== strval($examenR[$alumno->id]) ||
                        strval($registro->calificacion) !== strval($calificacion[$alumno->id]) ||
                        strval($registro->faltas) !== strval($faltas[$alumno->id])) {
                        
                        $registro->examenR=$examenR[$alumno->id];
                        $registro->calificacion=$calificacion[$alumno->id];
                        $registro->faltas=$faltas[$alumno->id];
                        $registro->updated_at=now();
                        $registro->save();
                    } 
                    
                }else{
                    $hora=now();
                    $calificacion=$calificacion[$alumno->id];
                    if($calificacion=''){
                        $calificacion=0;
                    }
                    $dataSave =[
                        'periodo' => $periodo,
                        'examenR' => $examenR[$alumno->id],
                        'calificacion' => $calificacion,
                        'faltas' => $faltas[$alumno->id],
                        'alumno_id' => $alumno_id[$alumno->id],
                        'clase_id' => $clase_id,
                        'created_at' => $hora,
                        'updated_at' => $hora,
                    ];
                    DB::table('calificacion')->insert($dataSave);
                }
            }
            
        }
        return redirect('/docente/calificaciones/general/'.$clase_id);
    }


    public function validarReportes(Request $request)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
            'puntaje'=>'required',
            'asunto'=>'required',
            'fecha'=>'required|date',
            'observaciones'=>'required',
            'alumno_id'=>'required',
        ],
        [   
            'observaciones.required'=>'Debe ingresar una descripción detallada',
            'puntaje.required'=>'Es obligatorio asignar al menos un punto',
            'asunto.required'=>'es de suma importancia que se agregue el asunto del reporte'
        ]);
    }
    public function validarCalificaciones(Request $request)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
            'calificacion[]'=>'required',
            'faltas[]'=>'required',
        ],
        [   
            'required'=>'Es necesario para continuar',
        ]);
    }

    public function visionGeneral($id){

        $clase =Clase::find($id);
        //$alumnos = Alumno::select('id', 'status','persona_id','grupo_id')->where('grupo_id', $clase->grupo->id)->orderBy('id', 'desc')->get();
        $periodo = '0';
        return view('modDocente.visionGeneral',compact('clase','periodo'));
    }


}
