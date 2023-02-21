<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Persona;
use App\Models\Tutor;
use App\Models\Grupo;

class InscripcionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $alumnos=Alumno::all();

        return view('modSecretaria.panelSecretaria',compact('alumnos'));
    }

    public function create()
    {
        $tutores=Tutor::all();
        return view('modSecretaria.inscripcionCreate',compact('tutores'));
    }


    public function store(Request $request)
    {
        // validamos el formulario completo
        $this->validar($request);

        // creamos el alumno, el cual  ligamos con el tutor, dejamos pendiente el tutor
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


        //si  existe el tutor 
        if($request->input('existeTutor')=='si'){
            //solamente obtenemos el id
            $alumno->tutor_id = $request->get('tutor_id');
        }else{
            //creamos al tutor
            $this->validarExtras($request);
            $tutor=new Tutor();
            $personaTutor=new Persona();

            $personaTutor->nombre=$request->get('nombreTutor');
            $personaTutor->apellido_p=$request->get('apellido_pTutor');
            $personaTutor->apellido_m=$request->get('apellido_mTutor');
            $personaTutor->sexo=$request->get('sexoTutor');
            $personaTutor->fecha_nacimiento=$request->get('fecha_nacimientoTutor');

            $tutor->telefono_1= $request->input('telefono_1');
            $tutor->telefono_2= $request->input('telefono_2');
            $tutor->correo= $request->input('correo');
            $tutor->estado= $request->input('estado');
            $tutor->municipio= $request->input('municipio');
            $tutor->colonia= $request->input('colonia');
            $tutor->calle= $request->input('calle');
            $tutor->numero= $request->input('numero');
            if($request->input('numero')==''){
                $tutor->numero= 'S/N';
            }

            $personaTutor->save();
            $personaTutor->tutor()->save($tutor);

            //retomamos  el campo tutor del alumno
            $alumno->tutor_id = $tutor->id;
        }

        //ahora si podemos  guardar al alumno ligado a su tutor
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
        return view('modSecretaria.inscripcionEdit', compact('persona','tutores','grupos'));
    }

    public function update(Request $request, $id)
    {
        $this->validar($request);
        // creamos el alumno, el cual  ligamos con el tutor, dejamos pendiente el tutor
        $alumno = Alumno::find($id);

        $alumno->persona->nombre=$request->get('nombre');
        $alumno->persona->apellido_p=$request->get('apellido_p');
        $alumno->persona->apellido_m=$request->get('apellido_m');
        $alumno->persona->sexo=$request->get('sexo');
        $alumno->persona->fecha_nacimiento=$request->get('fecha_nacimiento');
        $alumno->curp=$request->get('curp');
        $alumno->status=$request->get('status');
        $alumno->fechaInscripcion=$request->get('fechaInscripcion');
        $alumno->grado=$request->get('grado');


        //si  existe el tutor 
        if($request->input('existeTutor')=='si'){
            //solamente obtenemos el id
            $alumno->tutor_id = $request->get('tutor_id');
        }else{
            $this->validate($request, [
                'fecha_nacimientoTutor'=>'date|before_or_equal:-18 year',
                'telefono_2'=>'nullable|size:10',
                'correo'=>'nullable|email|unique:Tutor,correo',
                "telefono_1" => "required|unique:Tutor,telefono_1," . $alumno->tutor_id.",id",
                "correo" => "nullable|unique:Trabajador,correo," . $alumno->tutor_id.",id",
            ],
            [   
                'fecha_nacimientoTutor.before_or_equal'=>'El tutor debe ser mayor de edad',
                'correo.unique'=>'Este correo ya ha sido registrado, pruebe con uno diferente',
                'size'=>'Deben ser 10 dígitos consecutivos: (9512409834)',
                'email'=>'Debe ingrsar un correo válido',
                'telefono_1.unique'=>'Este teléfono ya esta registrado como principal de un estudiante, sólo  teléfonos secundarios pueden ser  repetidos',
    
            ]);
            //creamos al tutor
            if($alumno->tutor_id==null){
                $tutor=new Tutor();
                $personaTutor=new Persona();
                $personaTutor->nombre=$request->get('nombreTutor');
                $personaTutor->apellido_p=$request->get('apellido_pTutor');
                $personaTutor->apellido_m=$request->get('apellido_mTutor');
                $personaTutor->sexo=$request->get('sexoTutor');
                $personaTutor->fecha_nacimiento=$request->get('fecha_nacimientoTutor');

                $tutor->telefono_1= $request->input('telefono_1');
                $tutor->telefono_2= $request->input('telefono_2');
                $tutor->correo= $request->input('correo');
                $tutor->estado= $request->input('estado');
                $tutor->municipio= $request->input('municipio');
                $tutor->colonia= $request->input('colonia');
                $tutor->calle= $request->input('calle');
                $tutor->numero= $request->input('numero');
                if($request->input('numero')==''){
                    $tutor->numero= 'S/N';
                }

                $personaTutor->save();
                $personaTutor->tutor()->save($tutor);

                //retomamos  el campo tutor del alumno
                $alumno->tutor_id = $tutor->id;

            }else{
                $tutor=Tutor::find($alumno->tutor_id);
                $tutor->persona->nombre=$request->get('nombreTutor');
                $tutor->persona->apellido_p=$request->get('apellido_pTutor');
                $tutor->persona->apellido_m=$request->get('apellido_mTutor');
                $tutor->persona->sexo=$request->get('sexoTutor');
                $tutor->persona->fecha_nacimiento=$request->get('fecha_nacimientoTutor');

                $tutor->telefono_1= $request->input('telefono_1');
                $tutor->telefono_2= $request->input('telefono_2');
                $tutor->correo= $request->input('correo');
                $tutor->estado= $request->input('estado');
                $tutor->municipio= $request->input('municipio');
                $tutor->colonia= $request->input('colonia');
                $tutor->calle= $request->input('calle');
                $tutor->numero= $request->input('numero');
                if($request->input('numero')==''){
                    $tutor->numero= 'S/N';
                }
                $tutor->save();
                $tutor->persona->save();
            }
        }
        $alumno->save();
        $alumno->persona->save();
        return redirect('/secretarias');
    }


    public function destroy($id)
    {
        //
    }

    public function validar(Request $request){
        $this->validate($request, [
            'nombre'=>'required',
            'apellido_p'=>'required|between:3,10',
            'apellido_m'=>'nullable',
            'sexo'=>'required',
            'fecha_nacimiento'=>'required|date|before:-5 year',
            'curp'=>'required',
            'status'=>'required',
            'fechaInscripcion'=>'required',
            'grado'=>'required',

            'nombreTutor'=>'required_if:existeTutor,no',
            'apellido_pTutor'=>'required_if:existeTutor,no',
            'apellido_mTutor'=>'required_if:existeTutor,no',
            'sexoTutor'=>'required_if:existeTutor,no',
            'fecha_nacimientoTutor'=>'required_if:existeTutor,no',
            'telefono_1'=>'required_if:existeTutor,no',
            'estado'=>'required_if:existeTutor,no',
            'municipio'=>'required_if:existeTutor,no',
            'colonia'=>'required_if:existeTutor,no',
            'calle'=>'required_if:existeTutor,no',
            'tutor_id'=>'required_if:existeTutor,si'

        ],
        [   'nombre.required'=>'El nombre es requerido',
            'apellido_p.required'=>'El primer apellido es obligatorio',
            'apellido_m.required'=>'El segundo apellido es obligatorio',
            'fecha_nacimiento.required'=>'Ingrese la fecha de nacimiento del alumn@',
            'fecha_nacimiento.before'=>'La edad mínima de inscripción es de 5 años',
            'curp.required'=>'El CURP es obligatorio',
            'status.required'=>'El status es obligatorio',
            'fechaInscripcion.required'=>'La fecha de inscripción es obligatoria',
            'grado.required'=>'¿a qué grado va a ingresar el aluimno?',
            'required'=> 'Este campo es obligatorio',
            'required_if'=>'Este campo es obligatorio si actualmente no existe el tutor',
            'tutor_id.required_if'=>'Este campo es obligatorio si actualmente ya existe el tutor'
        ]);
    }

    public function validarExtras(Request $request){
        $this->validate($request, [
            'telefono_1'=>'size:10|unique:Tutor,telefono_1',
            'fecha_nacimientoTutor'=>'date|before_or_equal:-18 year',
            'telefono_2'=>'nullable|size:10',
            'correo'=>'nullable|email|unique:Tutor,correo'
        ],
        [   
            'fecha_nacimientoTutor.before_or_equal'=>'El tutor debe ser mayor de edad',
            'correo.unique'=>'Este correo ya ha sido registrado, pruebe con uno diferente',
            'size'=>'Deben ser 10 dígitos consecutivos: (9512409834)',
            'email'=>'Debe ingrsar un correo válido',
            'telefono_1.unique'=>'Este teléfono ya esta registrado como principal de un estudiante, sólo  teléfonos secundarios pueden ser  repetidos',

        ]);
    }

}
