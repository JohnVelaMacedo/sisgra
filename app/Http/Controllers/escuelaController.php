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
        $user       = $user->user;
        $encargado  = \DB::select("SELECT p.DNI as id, e.Nombre as escuela, concat_ws(' ',p.Nombre,p.Apellidos) as encargado  FROM persona p 
        JOIN escuelaprofesional e ON p.idFacultad=e.idFacultad 
        WHERE p.DNI='$user'");
        $escuela    = \DB::select("SELECT e.idEscuela as id, e.Nombre as escuela FROM escuelaprofesional e 
        JOIN persona p ON e.idFacultad=p.idFacultad
        WHERE p.DNI='$user'");
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
        $user       = $user->user;
        $var = \DB::select("SELECT p.`idFacultad` FROM persona p WHERE p.dni='$user'");
        return $var;
    }
    public function getEscuelas()
    {
        $personas   = $this->idFacultad();
        foreach ($personas as $key) {
            $id = $key->idFacultad;
        }
        // $escuelas = EscuelaProfesional::all()->where('idFacultad',$id);
        $escuelas = \DB::select("SELECT g.`DNI`,g.`Nombre`,g.`Telefono`,g.`Correo`,e.Nombre escuela,g.`Ingreso`,g.`egreso`,g.`AnioBachiller`,g.`AnioTitulo` FROM graduado g
        JOIN escuelaprofesional e ON e.idEscuela=g.Escuela
        WHERE g.Facultad=$id");
        return compact('escuelas');
    }
    public function addEncargado(Request $request)
    {
        $persona    = new Persona();
        $user       = new User();
        $idFacultad     = $this->idFacultad();
        foreach ($idFacultad as $fac) {
            $var = $fac->idFacultad;
        }
        $persona->DNI           =   $request->persona['dni'];
        $persona->Nombre        =   ucwords($request->persona['nombre']);
        $persona->Apellidos     =   ucwords($request->persona['ape']);
        $persona->Telefono      =   $request->persona['cel'];
        $persona->Direccion     =   ucwords($request->persona['dir']);
        $persona->idFacultad    =   $var;
        $persona->idEscuela     =   $request->persona['idesc'];
        $persona->Correo        =   $request->persona['correo'];
        $persona->Estado        =   1;
        $user->id               =   $request->persona['dni'];
        $user->user             =   $request->persona['dni'];
        $user->password         =   bcrypt($request->persona['dni']);   
        $user->tipo             =   3;
        $user->estado           =   1; 
        $persona->save();
        $user->save();
        return 'ok';
    }
    public function getEncargado()
    {
        $personas   = $this->idFacultad();    
        foreach ($personas as $key) {
            $id = $key->idFacultad;
        }
        $escuelas = EscuelaProfesional::all()->where('idFacultad',$id);
        $encargados = \DB::select("SELECT p.DNI as ID, concat_ws(' ',p.Nombre,p.Apellidos) as encargado, e.`Nombre` as escuela FROM escuelaprofesional e 
        JOIN persona p ON e.idFacultad=p.idFacultad
        WHERE (NOT p.idEscuela = 0) AND p.idFacultad=$id");
        return compact('escuelas','encargados');
    }
    public function alterTable()
    {
        $xd = \Schema::table('persona', function (Blueprint $table) {
            $table->string('Nombre', 50)->change();
        });
        return compact('xd');
    }
}
