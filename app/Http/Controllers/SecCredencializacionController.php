<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class SecCredencializacionController extends Controller
{
    public function index()
    {
        $alumnos=Alumno::all();
        return view('modSecretaria.credencialIndex',compact('alumnos'));
    }
    public function create()
    {
        return "Hola desde el create sec credenciales";
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        $alumno=Alumno::find($id);
        $nombreCompleto=$alumno->persona->nombre." ".$alumno->persona->apellido_p." ".$alumno->persona->apellido_m;
        $grupo=$alumno->grupo->nombre[0]."° ".$alumno->grupo->nombre[1];


        $datos[0]=['nombre'=>$nombreCompleto,
        'curp'=>$alumno->curp,
        'grupo'=>$grupo];

        //return view('credencial.credencial',compact('datos'));
        $pdf = app('dompdf.wrapper');
        //se carga el html junto con los datos que recibira
        $pdf = \PDF::loadView('modSecretaria.credencialPDF',compact('datos'));
        $pdf->setPaper('letter');
        return view('modSecretaria.credencialPDF',compact('datos'));
        //return $pdf->download('credencial.pdf');
    }

    public function edit($id)
    {
        $alumno=Alumno::find($id);
        $nombreCompleto=$alumno->persona->nombre." ".$alumno->persona->apellido_p." ".$alumno->persona->apellido_m;
        $grupo=$alumno->grupo->nombre[0]."° ".$alumno->grupo->nombre[1];


        $datos[0]=['nombre'=>$nombreCompleto,
        'curp'=>$alumno->curp,
        'grupo'=>$grupo];

        //return view('credencial.credencial',compact('datos'));
        $pdf = app('dompdf.wrapper');
        //se carga el html junto con los datos que recibira
        $pdf = \PDF::loadView('modSecretaria.credencialPDF',compact('datos'));
        $pdf->setPaper('letter');
        return $pdf->download('modSecretaria.credencialPDF');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function funcionRandom()
    {
        return "Hola desde el random sec credenciales";
    }


}
