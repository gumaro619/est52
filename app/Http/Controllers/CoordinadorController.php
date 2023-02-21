<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class CoordinadorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return "ola k ase";
    }
    public function bajas(){
        $alumnos=Alumno::all();
        return view('modCoordinador.bajas',compact('alumnos'));
    }
    public function bajaTemp($id){
        $alumno = Alumno::find($id);
        $alumno->status = 'baja temporal';
        $alumno->save();
        return redirect('/bajas');
    }
    public function bajaDef($id){
        $alumno = Alumno::find($id);
        $alumno->status = 'baja definitiva';
        $alumno->save();
        return redirect('/bajas');
    }

}
