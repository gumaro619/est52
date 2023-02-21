<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Tutor;
use App\Models\Calificacion;

class SecretariaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $alumnos=Alumno::all();
        return view('modSecretaria.panelSecretaria',compact('alumnos'));
    }

    public function alumnos(){
        $alumnos=Alumno::all();
        return view('modSecretaria.alumnosIndex',compact('alumnos'));
    }

    public function tutores(){
        $tutores=Tutor::all();
        return view('modSecretaria.tutoresIndex',compact('tutores'));
    }

    //funciuones de prototipo 2

    public function calificaciones(){
        $calificaciones=Calificacion::all();
        return view('modSecretaria.calificaciones',compact('calificaciones'));
    }

}
