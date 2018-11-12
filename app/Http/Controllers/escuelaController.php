<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Graduado;
use App\EscuelaProfesional;
use App\User;
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

        // Obteniendo el tipo de Estado Civil
        $graduadoEscuela = Graduado::where('Escuela', $persona->idEscuela)->get();

        // return view('graduado.index', compact('graduado', 'discapacidad', 'escuela', 'facultad', 'departamento', 'estado_civil'));
        return compact('persona','graduadoEscuela');
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
        //
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
    public function getDatos()
    {
        $user       = \Auth::user();
        $user       = $user->id;
        $encargado  = \DB::select('CALL `SP_EncargadoEscuela`(?)',[
            $user
        ]);
        $escuela    = \DB::select('CALL `SP_Escuelas`(?)',[
            $user
        ]);
        return compact('encargado','escuela');
    }
    public function ingresarEscuela(Request $request)
    {
        $idFacultad     = $this->idFacultad();
        $esc            = new EscuelaProfesional();
        $var;
        foreach ($idFacultad as $fac) {
            $var = $fac->idFacultad;
        }
        $esc->Nombre    = $request->facu;
        $esc->idFacultad= $var;
        $esc->save();
        // return "bien";
        
        // return $idFacultad;
    }
    public function idEscuela()
    {

    }
    public function idFacultad()
    {
        $user       = \Auth::user();
        $user       = $user->id;
        $var = \DB::select('CALL `SP_idFacultad`(?)',[$user]);
        return $var;
    }
}
