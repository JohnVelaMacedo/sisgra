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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Auth::user();
        $user = $user->id;

        // Obteniendo Graduado
        $graduado = Graduado::where('DNI', $user)->first();

        // Obteniendo el tipo de discapacidad
        $discapacidad = Discapacidad::where('id', $graduado->Discapacidad)->first();

        // Obteniendo el tipo de Escuela
        $escuela = EscuelaProfesional::where('idEscuela', $graduado->Escuela)->get();

        // Obteniendo el tipo de Escuela
        $facultad = Facultad::where('id', $graduado->Facultad)->get();

        // Obteniendo el tipo de Escuela
        $departamento = DepartamentoEstado::where('DepartamentoEstado', $graduado->EstadoDepartamento)->get();

        // Obteniendo el tipo de Estado Civil
        $estado_civil = EstadoCivil::where('id', $graduado->EstadoCivil)->get();

        return view('graduado.index', compact('graduado', 'discapacidad', 'escuela', 'facultad', 'departamento', 'estado_civil'));
    }

    public function getDatos() {
        $user = \Auth::user();
        $user = $user->id;

        $resultado = \DB::select("SELECT g.DNI, g.Nombre, g.Telefono, g.Correo, g.AnioNacimiento, g.Genero, p.Nombre as 'Pais', 
                                de.Nombre AS 'Departamento', g.DistritoCiudad, g.Dirección, ec.descripcion AS 'Estado_Civil', 
                                g.CantHijos, d.descripcion AS 'Discapacidad', f.Nombre AS 'Facultad', ep.Nombre AS 'Escuela_Profesional',
                                g.Ingreso, g.egreso, g.AnioBachiller, g.AnioTitulo 
                                FROM graduado g
                                INNER JOIN pais p ON p.idPais = g.PaisResidencia
                                INNER JOIN departamentoestado de ON de.DepartamentoEstado = g.EstadoDepartamento
                                INNER JOIN estadocivil ec ON ec.id = g.EstadoCivil
                                INNER JOIN discapacidad d ON d.id = g.Discapacidad
                                INNER JOIN facultad f ON f.id = g.Facultad
                                INNER JOIN escuelaprofesional ep ON ep.idEscuela = g.Escuela
                                WHERE DNI = ?", [$user]);
        return compact('resultado');
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
