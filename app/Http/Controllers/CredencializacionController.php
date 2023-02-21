<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class CredencializacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $alumnos=Alumno::all();
        return view('modSecretaria.credencialIndex',compact('alumnos'));
    }

    public function create()
    {
        return "Hola desde el create credencializacion";
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
