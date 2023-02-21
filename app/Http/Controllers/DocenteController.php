<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Docente;
use App\Models\Persona;
use Illuminate\Validation\Rule;
use Validator;

class DocenteController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $trabajadores=Trabajador::where('puesto', 'DOCENTE')->get();
        return view('vistasDocente.index',compact('trabajadores'));
    }


    public function create()
    {
        return view('vistasDocente.create');
    }


    public function store(Request $request)
    {
        $this->validar($request);

        $this->validate($request, [
            'fecha_nacimiento'=>'date|size:10'
        ],
        [   
            'size'=>'No es un formato válido de fecha',
        ]);
        $docente=new Docente();
        $trabajador=new Trabajador();
        $persona=new Persona();

        $persona->nombre=$request->get('nombre');
        $persona->apellido_p=$request->get('apellido_p');
        $persona->apellido_m=$request->get('apellido_m');
        if( $persona->apellido_m==null){
            $persona->apellido_m='';
        }
        $persona->sexo=$request->get('sexo');
        $persona->fecha_nacimiento=$request->get('fecha_nacimiento');

        $trabajador->puesto=$request->get('puesto');
        $trabajador->telefono=$request->get('telefono');
        $trabajador->correo=$request->get('correo');
        $trabajador->horas=0;

        if($request->get('status')=='activo'){
            $trabajador->status=1;
        }elseif($request->get('status')=='inactivo'){
            $trabajador->status=0;
        }else{
            $trabajador->status=-1;
        }

        $persona->save();
        $persona->trabajador()->save($trabajador);
        $persona->trabajador->docente()->save($docente);

        return redirect('/docentes');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $persona = Trabajador::find($id)->persona;
        return view('vistasDocente.update', compact( 'persona'));
    }

    public function update(Request $request, $id)
    {

        $trabajador = Trabajador::find($id);

        $this->validate($request, [
            'nombre'=>'required',
            'apellido_p'=>'required',
            'sexo'=>'required',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 year',
            "telefono" => "required|unique:Trabajador,telefono," . $id,
            "correo" => "required|unique:Trabajador,correo," . $id,
            'puesto'=>'required',
            'status'=>'required'
        ],
        [   
            'telefono.unique'=>'Este teléfono ya está registrado favor de  ingresar uno diferente',
            'correo.unique'=>'Este correo ya está registrado favor ded  ingresar uno diferente'
        ]);

        $trabajador->persona->nombre = $request->get('nombre');
        $trabajador->persona->apellido_p = $request->get('apellido_p');
        $trabajador->persona->apellido_m = $request->get('apellido_m');
        if($trabajador->persona->apellido_m==null){
            $trabajador->persona->apellido_m='';
        }
        $trabajador->persona->sexo = $request->get('sexo');
        $trabajador->persona->fecha_nacimiento = $request->get('fecha_nacimiento');
        
        $trabajador->puesto=$request->get('puesto');
        $trabajador->telefono=$request->get('telefono');
        $trabajador->correo=$request->get('correo');
        $trabajador->horas=0;

        if($request->get('status')=='activo'){
            $trabajador->status=1;
        }elseif($request->get('status')=='inactivo'){
            $trabajador->status=0;
        }else{
            $trabajador->status=-1;
        }

        $trabajador->save();
        $trabajador->persona->save();

        return redirect('/docentes');


    }


    public function destroy($id)
    {
        Trabajador::find($id)->persona()->delete();
        return redirect('/trabajadores');
    }

    public function validar(Request $request)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
            'nombre'=>'required',
            'apellido_p'=>'required',
            'sexo'=>'required',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 year',
            'puesto'=>'required',
            'telefono'=>'required|size:10|unique:Trabajador,telefono',
            'correo'=>'required|unique:Trabajador,correo',
            'status'=>'required'
        ],
        [   
            'nombre.required'=>'Debe ingresar el nombre',
            'apellido_p.required'=>'Es obligatorio asignar al menos un apellido',
            'required'=>'Este campo es obligatorio',
            'email'=>'Este campos debe ser un correo electrónico',
            'before_or_equal'=>'el docente debe ser mayor de edad',
            'telefono.unique'=>'este teléfono ya está ligado a un trabajador, utilize uno diferente',
            'correo.unique'=>'este corrreo ya está ligado a un trabajador, favor de usar uno diferente',
            'size'=>'El telefono debe contener 10 cdígitos',
            'date'=>'Introduzca una fecha válida'
        ]);
    }

    public function validarEdit(Request $request,$id)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
            'nombre'=>'required',
            'apellido_p'=>'required',
            'sexo'=>'required',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 year',
            "telefono" => "required|unique:Trabajador,telefono," . $id,
            "correo" => "required|unique:Trabajador,correo," . $id,
            'puesto'=>'required',
            'status'=>'required'
        ],);
    }
}
