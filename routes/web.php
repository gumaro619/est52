<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CredencializacionController;
use App\Http\Controllers\SecCredencializacionController;
use App\Http\Controllers\SecBoletasController;
use App\Http\Controllers\SecHorariosController;
use App\Http\Controllers\SecretariaController;

Route::get('/', function () {
    return view('auth.login');
});


//---------------------------rutas CRUD

Route::resource('/grupos', 'App\Http\Controllers\GrupoController')->names('grupos');

Route::resource('/aulas', 'App\Http\Controllers\AulaController')->names('aulas');

//4.- crear la ruta  para todo el CRUD  de esa tabla (5->views->index)
Route::resource('/materias', 'App\Http\Controllers\MateriaController')->names('materias');

Route::resource('/personas', 'App\Http\Controllers\PersonaController')->names('personas');

Route::resource('/tutores', 'App\Http\Controllers\TutorController')->names('tutores');

Route::resource('/trabajadores', 'App\Http\Controllers\TrabajadorController')->names('trabajadores');

Route::resource('/docentes', 'App\Http\Controllers\DocenteController')->names('docentes');

Route::resource('/alumnos', 'App\Http\Controllers\AlumnoController')->names('alumnos');

Route::resource('/reportes', 'App\Http\Controllers\ReporteController')->names('reportes');

Route::resource('/clases', 'App\Http\Controllers\ClaseController')->names('clases');

Route::resource('/calificaciones','App\Http\Controllers\CalificacionController')->names('calificaciones');

//rutas para EL MÓDULO secretaria
Route::resource('/inscripciones','App\Http\Controllers\InscripcionController')->names('inscripciones');
Route::resource('/credencializacion',SecCredencializacionController::class)->names('credencializacion');
Route::resource('/horarios',SecHorariosController::class)->names('horarios');
Route::resource('/boletas',SecBoletasController::class)->names('boletas');

Route::get('/secretarias','App\Http\Controllers\SecretariaController@index')->name('secretarias');
Route::get('/secretarias/alumnos','App\Http\Controllers\SecretariaController@alumnos')->name('secretarias.alumnos');
Route::get('/secretarias/tutores','App\Http\Controllers\SecretariaController@tutores')->name('secretarias.alumnos');

Route::get('/secretarias/calificaciones','App\Http\Controllers\SecretariaController@calificaciones')->name('secretarias.calificaciones');

//rutas para el modilo de  COORDINADOR ACADEMICO

Route::get('/coordinacion','App\Http\Controllers\CoordinadorController@index')->name('coordinacion');
Route::get('/bajas','App\Http\Controllers\CoordinadorController@bajas')->name('bajas');
Route::get('/bajas/temporal/{id}','App\Http\Controllers\CoordinadorController@bajaTemp')->name('bajas.temp');
Route::get('/bajas/definitiva/{id}','App\Http\Controllers\CoordinadorController@bajaDef')->name('bajas.deef');

//RUTAS PARA EL MÓDULO DE DONCENCIA
    //login artificial index DOCENTES
Route::get('/docente','App\Http\Controllers\UsrDocenteController@index')->name('docente');
    //rutas del docente
Route::get('/docente/{id}','App\Http\Controllers\UsrDocenteController@dashboard')->name('docente.dashboard');
Route::get('/docente/calificaciones','App\Http\Controllers\UsrDocenteController@calificaciones')->name('docente.calificaciones');
Route::get('/docente/calificaciones/{id}','App\Http\Controllers\UsrDocenteController@calificarClase')->name('docente.calificaciones.clase');
Route::post('/docente/calificaciones','App\Http\Controllers\UsrDocenteController@reportarCalificaciones')->name('docente.calificaciones.store');
Route::post('/docente/calificaciones/periodo','App\Http\Controllers\UsrDocenteController@preStoreCalificaciones')->name('docente.calificaciones.periodo');
Route::get('/docente/calificaciones/general/{id}','App\Http\Controllers\UsrDocenteController@visionGeneral')->name('docente.calificaciones.general');

Route::get('/docente/reportes/{id}','App\Http\Controllers\UsrDocenteController@reportes')->name('docente.reportes');
Route::post('/docente/reportes','App\Http\Controllers\UsrDocenteController@reportar')->name('docente.reportar');


//RUTAS PARA EL MÓDULO DE  TUTORES
Route::get('/tutor','App\Http\Controllers\UsrTutorController@index')->name('tutor');
Route::get('/tutor/confirmar','App\Http\Controllers\UsrTutorController@confirmarDatos')->name('tutor.confirmar');
Route::get('/tutor/mostrar/{id}','App\Http\Controllers\UsrTutorController@mostrar')->name('tutor.mostrar');
Route::get('/tutor/tutorado/{id}','App\Http\Controllers\UsrTutorController@mostrarTutorado')->name('tutor.tutorado');
Route::get('/tutor/faqs','App\Http\Controllers\UsrTutorController@faqs')->name('tutor.faqs');
Route::get('/tutor/actualizar/{id}','App\Http\Controllers\UsrTutorController@actualizarDatos')->name('tutor.actualizar');
Route::post('/tutor/actualizar','App\Http\Controllers\UsrTutorController@storeDatos')->name('tutor.store');


//RUTAS PARA EL MÓDULO DE  trabajador
    //login artificial index
Route::get('/trabajador','App\Http\Controllers\UsrTrabajadorController@index')->name('trabajador');
    //reporte rapido
Route::get('/trabajador/{id}','App\Http\Controllers\UsrTrabajadorController@mostrarTrabajador')->name('trabajador.mostrar');
Route::post('/trabajador/reportar','App\Http\Controllers\UsrTrabajadorController@reportar')->name('trabajador.reportar');
Route::get('/trabajador/reportes/simple/{id}','App\Http\Controllers\UsrTrabajadorController@formatoSimple')->name('trabajador.reportes.simple');

Route::get('/trabajador/reportes/completo/{id}','App\Http\Controllers\UsrTrabajadorController@formatoCompleto')->name('trabajador.reportes.completo');
Route::post('/trabajador/reportes/completo','App\Http\Controllers\UsrTrabajadorController@reportarCompleto')->name('trabajador.reportes.completo.store');
    //edit
//Route::get('/trabajador/reportes/edit/{id}','App\Http\Controllers\UsrTrabajadorController@updateReporte')->name('trabajador.reportes.actualizar');
Route::post('/trabajador/reportes/edit','App\Http\Controllers\UsrTrabajadorController@storeUpdateReporte')->name('trabajador.reportes.completo.update');
Route::get('/trabajador/reportes/edit','App\Http\Controllers\UsrTrabajadorController@updateReporte')->name('trabajador.reportes.actualizar');


    //index reportes del trabajador
Route::get('/trabajador/reportes/{id}','App\Http\Controllers\UsrTrabajadorController@mostrarReportes')->name('trabajador.reportes');
Route::delete('/trabajador/reportes/{id}','App\Http\Controllers\UsrTrabajadorController@destroy')->name('trabajador.reportes.destroy');
    //ver infomración estudiantil  recibe un array
Route::post('/trabajador/alumnos','App\Http\Controllers\UsrTrabajadorController@mostrarAlumnos')->name('trabajador.alumnos');

//Vista de alumnos en forma de lista,  USAMOS UN GET  pero que se maneja por Request, al ser más dinámico que las variables del tipo {{/$id}}
Route::get('/trabajador/alumnos/lista','App\Http\Controllers\UsrTrabajadorController@listarAlumnos')->name('trabajador.alumnos.lista');


Route::get('/curp', function () {
    return view('modSecretaria.curp');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
