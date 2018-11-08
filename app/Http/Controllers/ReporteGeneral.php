<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;   

class ReporteGeneral extends Controller
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
    /**Funcion para crear una hoja de excel teniendo los datos en una consulta
     */
    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        // Excel::create('Laravel Excel', function($excel) {
        //     $excel->sheet('Excel sheet', function($sheet) {

        //         // $user = \Auth::user();
        //         // $user = $user->id;
        //         // $resultado = \DB::select("CALL `SP_MostrarTodos`()");
        //         $resultado = Graduado::all();
        //         $sheet->fromArray($resultado);
        //         $sheet->setOrientation('landscape');
        //     });
        // })->export('xls');

        // $resultado = Graduado::all();
        return Excel::download(new UsersExport, 'graduado.xlsx');
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
        $user = \Auth::user();
        $user = $user->id;
        $resultado = \DB::select("CALL `SP_MostrarTodos`()");

        return compact('resultado');
    }
}
