<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Persona;

class TutorController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tutores=Tutor::all();
        return view('vistasTutor.index',compact('tutores'));

        //return view('vistasTutor.index',compact('tutores','personas'));
    }

    public function create()
    {
        return view('vistasTutor.create');
    }

    public function store(Request $request)
    {
        $this->validar($request);
        $tutorPersona = new PersonaController;
        $tutorPersona->storeTutor($request);

        $fkTutorPersona = json_decode($tutorPersona->ultimoRegistro() , true);
        $fkTutor =$fkTutorPersona['id'];
        
        //$datosTutor = new TutorController;
        //$datosTutor->store($request,$fkPersona['id']);

        $tutor = new Tutor;
        $tutor->telefono_1= $request->input('telefono_1');
        $tutor->telefono_2= $request->input('telefono_2');
        $tutor->correo= $request->input('correo');
        $tutor->estado= $request->input('estado');
        $tutor->municipio= $request->input('municipio');
        $tutor->colonia= $request->input('colonia');
        $tutor->calle= $request->input('calle');
        $tutor->numero= $request->input('numero');
        $tutor->persona_id= $fkTutor;
        
        if($request->input('numero')==''){
            $tutor->numero= 'S/N';
        }

        $tutor->save();

        return redirect('/tutores');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tutor= Tutor::find($id);
        //return view('vistasTutor.update', compact('tutor', 'persona'));

        $fkPersona=$tutor->persona_id;
        $persona = Persona::find($fkPersona);
    
        return view('vistasTutor.update', compact('tutor', 'persona'));
    }


    public function update(Request $request, $id)
    {
        $this->validar($request);
        //creamos el update se ejecuta solo cuadno recibe el submit de edit, ya podemos editar
        $tutorAEditar = Tutor::find($id);
        $personaAEditar = Persona::find($tutorAEditar->persona_id);

        $personaAEditar->nombre=$request->get('nombre');
        $personaAEditar->apellido_p=$request->get('apellido_p');
        $personaAEditar->apellido_m=$request->get('apellido_m');
        $personaAEditar->sexo=$request->get('sexo');
        $personaAEditar->fecha_nacimiento=$request->get('fecha_nacimiento');

        $tutorAEditar->telefono_1=$request->get('telefono_1');
        $tutorAEditar->telefono_2=$request->get('telefono_2');
        $tutorAEditar->correo=$request->get('correo');
        $tutorAEditar->estado=$request->get('estado');
        $tutorAEditar->municipio=$request->get('municipio');
        $tutorAEditar->colonia=$request->get('colonia');
        $tutorAEditar->calle=$request->get('calle');
        $tutorAEditar->numero=$request->get('numero');

        if($request->input('numero')==''){
            $tutorAEditar->numero='S/N';
        }

        $personaAEditar->save();
        $tutorAEditar->save();
        return redirect('/tutores');
    }


    public function destroy($id)
    {
        $tutorAEditar = Tutor::find($id);
        $personaAEditar = Persona::find($tutorAEditar->persona_id);
        $tutorAEditar->delete();
        $personaAEditar->delete();

        return redirect('/tutores');
    }

    public function validar(Request $request)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
            'nombre'=>'required',
            'apellido_p'=>'required',
            'apellido_m'=>'required',
            'sexo'=>'required',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 year',
            'telefono_1'=>['required','numeric','digits:10'],
            'telefono_2'=>'nullable|size:10',
            'correo' => 'nullable|email',
            'estado'=>'required',
            'municipio'=>'required',
            'colonia'=>'required',
            'calle'=>'required',
        ],
        [   'nombre.required'=>'El nombre es requerido',
            'apellido_p.required'=>'El primer apellido es obligatorio',
            'apellido_m.required'=>'El segundo apellido es obligatorio',
            'sexo.required'=>'Debe ingresar el sexo del(la) tutor(a)',
            'email'=>'Ingrese un correo válido',
            'fecha_nacimiento.required'=>'Es obligatoria la fecha de nacimiento',
            'fecha_nacimiento.before'=>'El tutor debe tener la mayotía de edad',
            'telefono_1.required'=>'Debe haber al menos un teléfono principal de contacto para emergencias',
            'digits'=>'El teléfono debe ser a 10 dígitos, incliuda la lada ',
            'size'=>'El teléfono debe ser a 10 dígitos, incliuda la lada ',
            'required'=>'Este campo es obligatorio'
        ]
    );
    }
}
