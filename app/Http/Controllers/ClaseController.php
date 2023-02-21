<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Grupo;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\Aula;

class ClaseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $clases=Clase::all();
        return view('vistasClase.index',compact('clases'));
    }

    public function create()
    {
        $docentes=Docente::all();
        $grupos=Grupo::all();
        $materias=Materia::all();
        $aulas=Aula::all();
        return view('vistasClase.create',compact('grupos','docentes','materias','aulas'));
    }

    public function store(Request $request)
    {
        $this->validar($request);

        if($request->dias==''){
            $this->validarDias($request);
        }

        $strDias=implode('',$request->dias);
        $clase=new Clase();
        $clase->horaE=$request->get('horaI');
        $clase->horaS=$request->get('horaF');

        $clase->dias=$strDias;
        $clase->docente_id=$request->get('docente_id');
        $clase->materia_id=$request->get('materia_id');
        $clase->grupo_id=$request->get('grupo_id');
        $clase->aula_id=$request->get('aula_id');

        $clase->save();

        return redirect('/clases');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $docentes=Docente::all();
        $grupos=Grupo::all();
        $materias=Materia::all();
        $aulas=Aula::all();

        $clase = Clase::find($id);
        return view('vistasClase.update', compact('clase','grupos','docentes','materias','aulas'));
    }

    public function update(Request $request, $id)
    {
        $this->validar($request);

        if($request->dias==''){
            $this->validarDias($request);
        }

        $strDias=implode('',$request->dias);
        $clase = Clase::find($id);
        $clase->horaE=$request->get('horaI');
        $clase->horaS=$request->get('horaF');

        $clase->dias=$strDias;
        $clase->docente_id=$request->get('docente_id');
        $clase->materia_id=$request->get('materia_id');
        $clase->grupo_id=$request->get('grupo_id');
        $clase->aula_id=$request->get('aula_id');

        $clase->save();
        return redirect('/clases');
    }

    public function destroy($id)
    {
        Clase::find($id)->delete();
        return redirect('/clases');
    }

    public function validar(Request $request){
        $this->validate($request, [
            'horaI'=>'required|after:06:59',
            'horaF'=>'required|after:horaI',
            'docente_id'=>'required',
            'materia_id'=>'required',
            'grupo_id'=>'required',
        ],
        [   
            'horaI.required'=>'Debe ingresar la hora inicial de la clase',
            'horaF.required'=>'Debe ingresar la hora final de la clase',
            'dias[].required'=>'Debe seleccionar al menos un día',
            'required'=>'Este campo es requerido',
            'date'=>'Debe ingresar una fecha válida',
            'correo'=>'Debe ingresar un correo válido',
            'horaI.after'=>'Las clases deben ser a partir de las 07:00 horas',
            'horaF.after'=>'La  hora final de la clase no puede ser antes de la hora inicial de la misma'
        ]);
    }

    public function validarDias(Request $request){
        $this->validate($request, [
            'dias[]'=>'required'
        ],[
            'required'=>'Debe ingresar al menos un día'
        ]);
    }
}
