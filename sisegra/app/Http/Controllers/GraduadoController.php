<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Graduado;
use App\Pais;
use App\DepartamentoEstado;
use App\EstadoCivil;
use App\Discapacidad;
use App\Facultad;
use App\GradoGraduado;
use App\User;
use App\EscuelaProfesional;

class GraduadoController extends Controller
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

    public function registrarGraduado()
    {
        $graduado = Graduado::all();
        $pais = Pais::all();
        $discapacidad = Discapacidad::all();
        $escuela = EscuelaProfesional::all();
        $facultad = Facultad::all();
        $departamento = DepartamentoEstado::all();
        $estado_civil = EstadoCivil::all(); 
        return view('graduado.registrar', compact('pais', 'discapacidad', 'escuela', 'facultad', 'departamento', 'estado_civil'));
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
        // Creando Graduado
        $graduado = new Graduado();
        $graduado->DNI = $request->dni;
        $graduado->Nombre = $request->nombre_completo;
        $graduado->Telefono = $request->telefono;
        $graduado->Correo = $request->correo;
        $graduado->AnioNacimiento = $request->anio_nacimiento;
        $graduado->Genero = $request->genero;
        $graduado->PaisResidencia = $request->pais;
        $graduado->EstadoDepartamento = $request->departamento;
        $graduado->DistritoCiudad = $request->distrito;
        $graduado->Dirección = $request->direccion;
        $graduado->EstadoCivil = $request->estado_civil;
        $graduado->CantHijos = $request->cantidad_hijos;
        $graduado->Discapacidad = $request->discapacidad;
        $graduado->Facultad = $request->facultad;
        $graduado->Escuela = $request->escuela;
        $graduado->Ingreso = $request->anio_ingreso;
        $graduado->egreso = $request->anio_egreso;
        $graduado->AnioBachiller = $request->anio_bachiller;
        $graduado->AnioTitulo = $request->anio_titulo;
        
        // Creando GradoGraduado
        $grado_graduado = new GradoGraduado();
        if ($request->anio_titulo) {
            $grado_graduado->Grado = 2;
        } else {
            $grado_graduado->Grado = 1;
        }
        $grado_graduado->idGraduado = $request->dni;
        $grado_graduado->anioGraduacion = $request->anio_bachiller;

        // Creando User
        $user = new User();
        $user->id = $request->dni;
        $user->user = $request->dni;
        $user->password = bcrypt('Inicio'.$request->dni);
        $user->tipo = 4;
        $user->estado = 0;

        $graduado->save();
        $grado_graduado->save();
        $user->save();
        
        return redirect('/');
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
