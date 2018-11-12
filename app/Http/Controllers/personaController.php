<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use Illuminate\Http\Request;

class personaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $persona = new Persona();
        $user    = new User();
        $persona->DNI       =$request->persona['dni'];
        $persona->Nombre    =$request->persona['nombre'];
        $persona->Apellidos =$request->persona['ape'];
        $persona->Telefono  =$request->persona['cel'];
        $persona->Direccion =$request->persona['dir'];
        $persona->idFacultad=$request->persona['idfacu'];
        $persona->idEscuela =0;
        $persona->Correo    =$request->persona['correo'];
        $persona->estado    =1;
        $user->id           =$request->persona['dni'];
        $user->user         =$request->persona['dni'];
        $user->password     =bcrypt('Inicio01');
        $user->tipo         =2;
        $user->estado       =1;
        $user->save();
        $persona->save();
        return "bien";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $user = $user->id;    
        $persona = Persona::where('DNI', $user)->get();
        return compact('persona');
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
        $persona = \DB::update("CALL `SP_ActualizarPersona`(?, ?, ?, ?, ?, ?)",[
            $request->persona['DNI'],
            $request->persona['Nombre'],
            $request->persona['Apellidos'],
            $request->persona['Telefono'],
            $request->persona['Direccion'],
            $request->persona['Correo']
        ]);
        if($persona) {
            return 'correcto';
        }
        return 'error';
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
