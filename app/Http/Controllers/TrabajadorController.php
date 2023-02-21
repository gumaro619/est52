<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Persona;


class TrabajadorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $trabajadores = Trabajador::select('*')
            ->where('puesto','<>','DOCENTE')
            ->get();
        return view('vistasTrabajador.index',compact('trabajadores'));
    }

    
    public function create()
    {
        return view('vistasTrabajador.create');

    }

    public function store(Request $request)
    {
        $this->validar($request);

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
        $trabajador->horas=$request->get('horas');

        if($request->get('status')=='activo'){
            $trabajador->status=1;
        }elseif($request->get('status')=='inactivo'){
            $trabajador->status=0;
        }else{
            $trabajador->status=-1;
        }

        $persona->save();
        $persona->trabajador()->save($trabajador);


        return redirect('/trabajadores');
    }

    public function edit($id)
    {
        $persona = Trabajador::find($id)->persona;
        return view('vistasTrabajador.update', compact('persona'));
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
            'status'=>'required',
            'horas'=>'required'
        ],
        [   
            'telefono.unique'=>'Este teléfono ya está registrado favor de  ingresar uno diferente',
            'correo.unique'=>'Este correo ya está registrado favor ded  ingresar uno diferente',
            'required'=>'Este campo es requerido',
            'date'=>'Debe ingresar una fecha válida',
            'correo'=>'Debe ingresar un correo válido'
        ]);

        $trabajador->persona->nombre = $request->get('nombre');
        $trabajador->persona->apellido_p = $request->get('apellido_p');
        $trabajador->persona->apellido_m = $request->get('apellido_m');
        $trabajador->persona->sexo = $request->get('sexo');
        $trabajador->persona->fecha_nacimiento = $request->get('fecha_nacimiento');
        
        $trabajador->puesto = $request->get('puesto');
        $trabajador->telefono = $request->get('telefono');
        $trabajador->correo = $request->get('correo');
        $trabajador->horas = $request->get('horas');
        $trabajador->status = $request->get('status');
        if($trabajador->status='activo'){
            $trabajador->status=1;
        }elseif($trabajador->status=='inactivo'){
            $trabajador->status=0;
        }else{
            $trabajador->status=-1;
        }

        $trabajador->save();
        $trabajador->persona->save();
        return redirect('/trabajadores');

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
            'puesto'=>'required',
            'apellido_p'=>'required',
            'sexo'=>'required',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 year',
            'horas'=>'required',
            'puesto'=>'required',
            'telefono'=>'required|size:10|unique:Trabajador,telefono',
            'correo'=>'required|unique:Trabajador,correo',
            'status'=>'required'
        ],
        [   
            'nombre.required'=>'Debe ingresar el nombre',
            'apellido_p.required'=>'Es obligatorio asignar al menos un apellido',
            'required'=>'Este campo es obligatorio',
            'email'=>'Debe ser un correo electrónico',
            'before_or_equal'=>'el trabajador debe ser mayor de edad',
            'telefono.unique'=>'este teléfono ya está ligado a un trabajador, utilize uno diferente',
            'correo.unique'=>'este corrreo ya está ligado a un trabajador, favor de usar uno diferente',
            'size'=>'El telefono debe contener 10 dígitos',
            'date'=>'Introduzca una fecha válida'
        ]);
    }
}
