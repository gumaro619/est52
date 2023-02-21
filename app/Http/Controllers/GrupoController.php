<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{

    //para que no nos permita ingrsar directamtre al panel desd ele login,
    // nos redirige al mismo login 
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {

        //Grupo::all();//todos los registros de la tabla
        $grupos= Grupo::all();

        return view('vistasGrupo.index',compact('grupos'));
    }

    public function create()
    {
        //
        return view('vistasGrupo.create');
    }

    public function store(Request $request)
    {
        //validamos primero antes que todo
        $this->validar($request);

        $grupo=new Grupo();
        $grupo->nombre=$request->get('grados')."°". $request->get('grupos');

        if($request->get('grupos')=="X"){
            $grupo->nombre=$request->get('grados')."°".$request->get('otro');
        }
        

        $grupo->ciclo=$request->get('ciclo1')."-".$request->get('ciclo2');
        $grupo->save();
        return redirect('/grupos');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $grupo= Grupo::find($id);
        return view('vistasGrupo.update')->with('grupo',$grupo);

    }

    public function update(Request $request, $id)
    {
        $this->validarEdit($request, $id);
        $grupoAEditar=Grupo::find($id);

        $grupoAEditar->nombre=$request->get('grados')."°". $request->get('grupos');
        if($request->get('grupos')=="X"){
            $grupoAEditar->nombre=$request->get('grados')."°".$request->get('otro');
        }
        $grupoAEditar->ciclo=$request->get('ciclo1')."-".$request->get('ciclo2');

        $grupoAEditar->save();
        return redirect('/grupos');
    }

    public function destroy($id)
    {
        //
        $grupoABorrar =Grupo::find($id);
        $grupoABorrar->delete();
        return redirect('/grupos');
    }

    public function validar(Request $request)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
                'otro'=>'required_if:grupos,X',
                'ciclo1'=>'required',
                'ciclo2'=>'required',
                'grupoFinal' => 'required|unique:Grupo,nombre,NULL,NULL,ciclo,'.$request->get('ciclo1')."-".$request->get('ciclo2')
            ],
            [   
                'grupoFinal.unique'=>'Este grupo ya existe en el ciclo escolar dado',
                'ciclo1.required'=>'Debe ingresar  el ciclo escolar ',
                'otro.required_if'=>'Ha seleccionado la opción  "otro", Debe especificar el grupo'
            ]
        );
    }

    public function validarEdit(Request $request, $id)
    {
        //FUNCIÓN AUXILIAR DE VALIDACIÓN DEl formualrio
        $this->validate($request, [
                'otro'=>'required_if:grupos,X',
                'ciclo1'=>'required',
                'ciclo2'=>'required',
                'grupoFinal' => 'required|unique:Grupo,nombre,'.$id.',id,ciclo,'.$request->get('ciclo1')."-".$request->get('ciclo2')
            ],
            [   
                'grupoFinal.unique'=>'Este grupo ya existe en el ciclo escolar dado',
                'ciclo1.required'=>'Debe ingresar  el ciclo escolar ',
                'otro.required_if'=>'Ha seleccionado la opción  "otro", Debe especificar el grupo'
            ]
        );
    }

}
