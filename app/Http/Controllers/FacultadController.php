<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facultad;
use App\Exports\ReporteFacultad;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;  

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $user = $user->user;
        $facultad = Facultad::all();
        return compact('facultad');
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
        $facu = new Facultad();
        $facu->Nombre=$request->facu;
        $facu->save();
        //     "Nombre"=>$request['facu']
        // ]);
        // if($facu){
        //     return "correcto";
        // }
        
        // return $request['facu'];
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
        $user = \Auth::user();
        $user = $user->id;
        $encargado = \DB::select("SELECT p.DNI as id,f.Nombre as facultad,concat_ws(' ',p.Nombre,p.Apellidos) as encargado FROM facultad f JOIN persona p ON f.id=p.idFacultad AND p.idEscuela=0");
        $facultad = Facultad::all();
        return compact('encargado', 'facultad');
    }
    
    public function getReporte()
    {        
       return Excel::download(new ReporteFacultad, 'Facultad.xlsx');
    }

    public function escuelaspdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $user = \Auth::user();
        $user = $user->user;
        $encargado = \DB::select("SELECT idFacultad as id FROM persona where DNI='$user'");
        foreach ($encargado as $key) {
            $id=$key->id;
        }
        $resultado = \DB::select("CALL `SP_ReporteFacultad`($id);");
        $facultad = Facultad::all()->where('id',$id);
        foreach ($facultad as $key) {
            $fac = $key->Nombre;
        }
       
        $pdf = PDF::loadView('reporteEscuelas', compact('resultado','fac'));
        $pdf->setPaper('A4', 'landscape');
        // $pdf = setPaper('A4', 'landscape');
        // $pdf->options->paperOrientation= 'landscape';
        return $pdf->stream('listado.pdf');
    }

}
