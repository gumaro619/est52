<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class SecBoletasController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $alumnos=Alumno::all();
        return view('modSecretaria.boletasIndex',compact('alumnos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $alumno=Alumno::find($id);
        //Asignamos  datos  iniciales
        $nombreCompleto=$alumno->persona->nombre." ".$alumno->persona->apellido_p." ".$alumno->persona->apellido_m;
        $grupo=$alumno->grupo->nombre[0]."° ".$alumno->grupo->nombre[1];

        

        $datos[0] =['nombre'=>$nombreCompleto,'grado'=>$grupo,'final'=>'9'];


        
        $info[0] = ['materia' => 'matematicas', 'cal1' => 10, 'fal1' => 0, 'cal1' => 10, 'fal1' => 0, 'cal2' => 10, 'fal2' => 0, 'cal3' => 10, 'fal3' => 0, 'promedio'=>10 ];
        $info[1] = ['materia' => 'español', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[2] = ['materia' => 'ingles', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[3] = ['materia' => 'biologia', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[4] = ['materia' => 'historia', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[5] = ['materia' => 'formacion civica', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 100, 'fal3' => 10, 'promedio'=>10 ];
        $info[6] = ['materia' => 'geografia', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[7] = ['materia' => 'artes', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[8] = ['materia' => 'tutoria', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 9, 'fal3' => 10, 'promedio'=>10 ];
        $info[9] = ['materia' => 'educ. fisica', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 8, 'fal3' => 10, 'promedio'=>10 ];
        $info[10] = ['materia' => 'vida saludable', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 7, 'fal3' => 10, 'promedio'=>10 ];
        $info[11] = ['materia' => 'tec', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 100, 'fal3' => 10, 'promedio'=>10 ];


        //desde a qui se genera el pdf
        $pdf = app('dompdf.wrapper');
        //se carga el html junto con los datos que recibira
        $pdf = PDF::loadView('modSecretaria.boletaPDF' ,compact('info'),compact('datos'));
        $pdf->setPaper('letter');

        return view('modSecretaria.boletaPDF',compact('info'),compact('datos'));
    }

    public function edit($id)
    {
        $datos[0] =['nombre'=>'gumaro de jesus olivera villalobos','grado'=>'3B','final'=>'9'];
        
        $info[0] = ['materia' => 'matematicas', 'cal1' => 10, 'fal1' => 0, 'cal1' => 10, 'fal1' => 0, 'cal2' => 10, 'fal2' => 0, 'cal3' => 10, 'fal3' => 0, 'promedio'=>10 ];
        $info[1] = ['materia' => 'español', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[2] = ['materia' => 'ingles', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[3] = ['materia' => 'biologia', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[4] = ['materia' => 'historia', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[5] = ['materia' => 'formacion civica', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 100, 'fal3' => 10, 'promedio'=>10 ];
        $info[6] = ['materia' => 'geografia', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[7] = ['materia' => 'artes', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 10, 'fal3' => 10, 'promedio'=>10 ];
        $info[8] = ['materia' => 'tutoria', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 9, 'fal3' => 10, 'promedio'=>10 ];
        $info[9] = ['materia' => 'educ. fisica', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 8, 'fal3' => 10, 'promedio'=>10 ];
        $info[10] = ['materia' => 'vida saludable', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 7, 'fal3' => 10, 'promedio'=>10 ];
        $info[11] = ['materia' => 'tec', 'cal1' => 10, 'fal1' => 10, 'cal1' => 10, 'fal1' => 10, 'cal2' => 100, 'fal2' => 10, 'cal3' => 100, 'fal3' => 10, 'promedio'=>10 ];

        //desde a qui se genera el pdf
        $pdf = app('dompdf.wrapper');
        //se carga el html junto con los datos que recibira
        $pdf = PDF::loadView('modSecretaria.boletaPDF' ,compact('info'),compact('datos'));
        $pdf->setPaper('letter');

        return $pdf->download('boleta.pdf');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        //
    }

    public function mostrar(){
        
    }

    public function CrearDocumento()
    {
        
    }

}
