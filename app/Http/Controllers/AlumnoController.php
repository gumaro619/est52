<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Persona;
use App\Models\Tutor;
use App\Models\Grupo;

class AlumnoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $alumnos=Alumno::all();
        return view('vistasAlumno.index',compact('alumnos'));
    }

    public function create()
    {
        $tutores=Tutor::all();
        $grupos=Grupo::all();
        return view('vistasAlumno.create',compact('tutores','grupos'));
    }

    public function store(Request $request)
    {
        $this->validar($request);
        $alumno=new Alumno();
        $persona=new Persona();

        $persona->nombre=$request->get('nombre');
        $persona->apellido_p=$request->get('apellido_p');
        $persona->apellido_m=$request->get('apellido_m');
        $persona->sexo=$request->get('sexo');
        $persona->fecha_nacimiento=$request->get('fecha_nacimiento');

        $alumno->curp=$request->get('curp');
        $alumno->status=$request->get('status');
        $alumno->fechaInscripcion=$request->get('fechaInscripcion');
        $alumno->grado=$request->get('grado');
        $alumno->tutor_id = $request->get('tutor_id');
        $alumno->grupo_id = $request->get('grupo_id');

        $persona->save();
        $persona->alumno()->save($alumno);

        return redirect('/alumnos');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tutores=Tutor::all();
        $grupos=Grupo::all();
        $persona = Alumno::find($id)->persona;
        return view('vistasAlumno.update', compact('persona','tutores','grupos'));
    }

    public function update(Request $request, $id)
    {
        $this->validar($request);

        $alumno = Alumno::find($id);

        $alumno->persona->nombre = $request->get('nombre');
        $alumno->persona->apellido_p = $request->get('apellido_p');
        $alumno->persona->apellido_m = $request->get('apellido_m');
        $alumno->persona->sexo = $request->get('sexo');
        $alumno->persona->fecha_nacimiento = $request->get('fecha_nacimiento');
        
        $alumno->curp = $request->get('curp');
        $alumno->status = $request->get('status');
        $alumno->fechaInscripcion = $request->get('fechaInscripcion');
        $alumno->grado = $request->get('grado');

        $alumno->tutor_id = $request->get('tutor_id');
        $alumno->grupo_id = $request->get('grupo_id');

        $alumno->save();
        $alumno->persona->save();
        return redirect('/alumnos');
    }

    public function destroy($id)
    {
        Alumno::find($id)->persona()->delete();
        return redirect('/alumnos');
    }

    public function validar(Request $request)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
            'nombre'=>'required',
            'apellido_p'=>'required',
            'fecha_nacimiento'=>'required|date|before:-5 year',
            'sexo'=>'required',
            'curp'=>'required',
            'status'=>'required',
            'fechaInscripcion'=>'required',
            'grado'=>'required'
        ],
        [   'nombre.required'=>'El nombre es requerido',
            'apellido_p.required'=>'El primer apellido es obligatorio',
            'apellido_m.required'=>'El segundo apellido es obligatorio',
            'sexo.required'=>'Debe ingresar el seXo del alumn@',
            'fecha_nacimiento.required'=>'Es obligatoria la fecha de nacimiento',
            'fecha_nacimiento.before'=>'El almn@ debe tener al menos 5 años',
            'curp.required'=>'El CURP es obligatorio',
            'status.required'=>'El status es obligatorio',
            'fechaInscripcion.required'=>'La fecha de inscripción es obligatoria',
            'grado.required'=>'¿a qué grado va a ingresar el aluimno (informatio)?'
        ]);
    }

}
