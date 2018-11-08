<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
class ReporteGeneral extends controller
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
        
        // Excel::create('Laravel Excel', function($excel) {
        // $excel->sheet('Excel sheet', function($sheet) {
        //     //otra opción -> $products = Product::select('name')->get();
        //     $resultado = \DB::select("CALL `SP_MostrarTodos`()");               
        //     $sheet->fromArray($resultado);
        //     $sheet->setOrientation('landscape');
        $resultado[] = array('nombre','apellidos','casa'); 
        return \Excel::download($resultado,'user.xlsx');
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
