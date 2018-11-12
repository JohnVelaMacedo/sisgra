<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Entidad;
use App\EmpresaGraduado;
use App\Graduado;
use App\EscuelaProfesional;
use App\User;
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

    public function updateEscuelaGraduado(Request $request)
    {
        // Actualizando Graduado
        $graduado = \DB::update("UPDATE graduado SET Nombre = ?, Telefono = ?, Correo = ?, AnioNacimiento = ?, 
                Genero = ?, PaisResidencia = ?, EstadoDepartamento = ?, DistritoCiudad = ?, Dirección = ?, EstadoCivil = ?, 
                CantHijos = ?, Discapacidad = ?, Facultad = ?, Escuela = ?, Ingreso = ?, egreso = ?, AnioBachiller = ?, AnioTitulo = ? 
                WHERE DNI = ?", [
                        $request->graduado['Nombre'], $request->graduado['Telefono'], $request->graduado['Correo'],
                        $request->graduado['AnioNacimiento'], $request->graduado['Genero'], $request->graduado['idPais'],
                        $request->graduado['DepartamentoEstado'], $request->graduado['DistritoCiudad'], $request->graduado['Dirección'],
                        $request->graduado['idEstadoCivil'], $request->graduado['CantHijos'], $request->graduado['idDiscapacidad'],
                        $request->graduado['idFacultad'], $request->graduado['idEscuela'], $request->graduado['Ingreso'],
                        $request->graduado['egreso'], $request->graduado['AnioBachiller'], $request->graduado['AnioTitulo'],
                        $request->graduado['DNI']
                ]);
                    
                $entidad = Entidad::updateOrCreate(
                    ['id' => $request['entidadEdit']['id']],
                    [
                        'descripcion' => $request['entidadEdit']['descripcion'],
                        'idRubro' => $request['entidadEdit']['idRubro'],
                        'telefono' => $request['entidadEdit']['telefono'],
                        'web' => $request['entidadEdit']['web'],
                        'idSector' => $request['entidadEdit']['idSector']
                    ]
                );
                
                $empresa = EmpresaGraduado::updateOrCreate(['idGraduado' => $request->graduado['DNI'], 'idEntidad' => $entidad->id]);
        
        // Actualizando GradoGraduado
        if (strlen($request->graduado['AnioTitulo']) > 0) {
            $grado = 2;
        } else {
            $grado = 1;
        }

        $grado_graduado = \DB::update('UPDATE gradograduado SET Grado = ?, AnioGraduacion = ? WHERE idGraduado = ?', [
            $grado,
            $request->graduado['AnioBachiller'],
            $request->graduado['DNI']
        ]);

        if($graduado || $entidad) {
            return 'correcto';
        }
        return 'error';
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
