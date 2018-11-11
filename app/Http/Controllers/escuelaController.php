<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Graduado;
use App\EscuelaProfesional;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\graduados2Import;

class escuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $user = $user->id;
        $persona=Persona::where('DNI',$user)->first();
        $escuelaDetalle=EscuelaProfesional::where('idEscuela',$persona->idEscuela)->first();

        // Obteniendo el tipo de Estado Civil
        $graduadoEscuela = Graduado::where('Escuela', $persona->idEscuela)->get();

        // return view('graduado.index', compact('graduado', 'discapacidad', 'escuela', 'facultad', 'departamento', 'estado_civil'));
        return compact('escuelaDetalle','persona','graduadoEscuela');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('excelG')){
            $path=$request->file('excelG')->getRealPath();
            Excel::import(new graduados2Import, request()->file('excelG'));
            return 'success'; 
        }else{
            return "No! It's not a File";
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
