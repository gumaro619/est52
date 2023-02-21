<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class SecHorariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $alumnos=Alumno::all();
        return view('modSecretaria.horariosIndex',compact('alumnos'));
    }

    public function create()
    {
        
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
        $grupo=$alumno->grupo->nombre;
        
        $datos[0] =['ciclo'=> '2022-2023',
                    'nombre'=>$nombreCompleto,
                    'grupo'=>$grupo];

        $info[0] = ['hora' => '7:00-8:00',

                    'lmat' => 'matematicas', 
                    'laula' => '2a',
                    'lp'=>'gumaro olivera',

                    'mmat' => 'español',
                    'maula' => '3a', 
                    'mp'=>'luis garcia',

                    'mimat' => 'españggol',
                    'miaula' => '2a', 
                    'mip'=>'gumaro olivera villalobos',

                    'jmat' => '', 
                    'jaula' => '',
                    'jp'=>'',
                        
                    'vmat' => 'ingles', 
                    'vaula' => '2b',
                    'vp'=>'gumaro de jesus olivera'
                    ];

                    $info[0] = ['hora' => '8:00-9:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];

                    $info[1] = ['hora' => '9:00-10:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];
                    $info[2] = ['hora' => '10:00-11:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];
                    $info[3] = ['hora' => '11:00-12:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];

                    $info[4] = ['hora' => '12:00-13:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];

        
        $pdf = app('dompdf.wrapper');
        //se carga el html junto con los datos que recibira
        $pdf = \PDF::loadView('modSecretaria.horarioPDF',compact('info'),compact('datos'));
        $pdf->setPaper('letter');
       //return $pdf->download('horario.pdf');
        return view('modSecretaria.horarioPDF',compact('info'),compact('datos')) ;
    }

    public function edit($id)
    {
        $alumno=Alumno::find($id);
        //Asignamos  datos  iniciales
        $nombreCompleto=$alumno->persona->nombre." ".$alumno->persona->apellido_p." ".$alumno->persona->apellido_m;
        $grupo=$alumno->grupo->nombre[0]."° ".$alumno->grupo->nombre[1];
        
        $datos[0] =['ciclo'=> '2022-2023','nombre'=>$nombreCompleto, 'grupo'=>$grupo];

        $info[0] = ['hora' => '7:00-8:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                        'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                        'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                        'jmat' => '', 'jaula' => '','jp'=>'',
                        'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];

                    $info[0] = ['hora' => '8:00-9:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];

                    $info[1] = ['hora' => '9:00-10:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];
                    $info[2] = ['hora' => '10:00-11:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];
                    $info[3] = ['hora' => '11:00-12:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];

                    $info[4] = ['hora' => '12:00-13:00', 'lmat' => 'matematicas', 'laula' => '2a','lp'=>'gumaro olivera',
                    'mmat' => 'español', 'maula' => '3a', 'mp'=>'luis garcia',
                    'mimat' => 'españggol', 'miaula' => '2a', 'mip'=>'gumaro olivera villalobos',
                    'jmat' => '', 'jaula' => '','jp'=>'',
                    'vmat' => 'ingles', 'vaula' => '2b','vp'=>'gumaro de jesus olivera'
                    ];

        
        $pdf = app('dompdf.wrapper');
        //se carga el html junto con los datos que recibira
        $pdf = \PDF::loadView('modSecretaria.horarioPDF',compact('info'),compact('datos'));
        $pdf->setPaper('letter');
        return $pdf->download('modSecretaria.horarioPDF');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
