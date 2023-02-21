<?php

namespace App\Http\Controllers;
use App\Models\Tutor;
use App\Models\Alumno;
use App\Models\Reporte;
use App\Models\Calificacion;


use Illuminate\Http\Request;

class UsrTutorController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $tutores=Tutor::all();
        return view('ModTutor.confirmar',compact('tutores'));

    }

    public function confirmarDatos(){
        return 'ola ka se desde datos confit tutor';
    }

    public function mostrar($id){
        //ES EL ID DEL TUTOR, SE BISCAN TODOS LOS ALUMNS  CUYO TUTOR SEA  $ID
        //mostrar alumnos del tutor
        //$alumnos = Alumno::select('*')
        //    ->where('tutor_id',$id)
        //    ->orderBy('id', 'desc')
        //    ->get();
        
        $tutor=Tutor::find($id);
        return view('ModTutor.dashboard',compact('tutor'));
        return view('ModTutor.mostrar',compact('tutor'));

    }

    public function mostrarTutorado($id){
        //recibimos el id de alumno 
        //$reportes = Reporte::all();

        //$reportes = Reporte::select('*')
        //    ->where('alumno_id',$id)
        //    ->orderBy('id', 'desc')
        //    ->get();
            
        $alumno=Alumno::find($id);
        //$calificaciones = Calificacion::all();
        //              p1  f1     p2   f2      p3  f3
        //materia1
        //materia2
        //materia3
        //
        
        return view('ModTutor.mostrarTutorado',compact('alumno'));
    }

    public function actualizarDatos($id){
        //recibimos el id de tutor 
        $tutor=Tutor::find($id);
        return view('ModTutor.actualizar',compact('tutor'));
    }

    public function faqs(){
        return view('ModTutor.FAQ');
    }

    public function storeDatos(Request $request){

        $this->validar($request);
        $tutor=Tutor::find($request->get('tutor_id'));

        $tutor->telefono_1=$request->get('telefono_1');
        $tutor->telefono_2=$request->get('telefono_2');
        $tutor->correo=$request->get('correo');
        $tutor->save();

        return view('ModTutor.mostrar',compact('tutor'));
    }

    public function validar(Request $request)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
            'telefono_2'=>'nullable|different:telefono_1|size:10',
            'correo'=>'nullable|email|unique:Tutor,correo',
            "telefono_1" => "required|size:10|unique:Tutor,telefono_1," . $request->get('tutor_id').",id",
            "correo" => "nullable|unique:Trabajador,correo," . $request->get('tutor_id').",id",
        ],
        [  
            'telefono_1.required'=>'Debe haber al menos un teléfono principal de contacto para emergencias',
            'digits'=>'El teléfono debe ser a 10 dígitos, incliuda la lada ',
            'size'=>'El teléfono debe ser a 10 dígitos, incliuda la lada ',
            'required'=>'Este campo es obligatorio',
            'different'=>'Ambos teléfonos no pueden ser los mismos'
        ]
    );
    }
}
