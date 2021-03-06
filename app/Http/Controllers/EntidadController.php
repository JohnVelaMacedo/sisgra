<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidad;
use App\Rubro;
use App\Sector;
use App\EmpresaGraduado;

class EntidadController extends Controller
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
        $rubro = Rubro::all();
        $sector = Sector::all();
        $empresa_graduado = EmpresaGraduado::where('idGraduado', $user)->first();
        if ($empresa_graduado != null) {
            $data = Entidad::where('id', $empresa_graduado->idEntidad)->get();
            return compact('data', 'rubro', 'sector', 'user');     
        }

        return compact('rubro', 'sector', 'user'); 
    }

    public function getEntidad($id){
        $rubro = Rubro::all();
        $sector = Sector::all();
        $empresa_graduado = EmpresaGraduado::where('idGraduado', $id)->first();
        if(!is_null($empresa_graduado)){
            $data = Entidad::where('id',$empresa_graduado->idEntidad)->first();
        }else{
            $data =array();
        }
        
        return compact('data', 'rubro', 'sector', 'empresa_graduado');
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
        $entidad = Entidad::updateOrCreate(
            ['id' => $request->params['data']['id']],
            [
                'descripcion' => $request->params['data']['descripcion'],
                'idRubro' => $request->params['data']['idRubro'],
                'telefono' => $request->params['data']['telefono'],
                'web' => $request->params['data']['web'],
                'idSector' => $request->params['data']['idSector']
            ]
        );
        
        $empresa = EmpresaGraduado::updateOrCreate(['idGraduado' => $request->params['user'], 'idEntidad' => $entidad->id]);
        
        if ($entidad && $empresa) {
            return 'correcto';
        }
        return "error";
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
