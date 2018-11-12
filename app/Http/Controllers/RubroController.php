<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rubro;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubro=Rubro::all();
        return compact('rubro');
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
        $sector = Rubro::updateOrCreate(
            ['id' => $request['rubroForm']['id']],
            [
                'descripcion' => $request['rubroForm']['descripcion']
            ]
        );
        if($sector){
            return "OK";
        }else{
            return "FAIL";
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
    public function edit(Request $request)
    {
        $rubro = Rubro::updateOrCreate(
            ['id' => $request['rubroEdit']['id']],
            [
                'descripcion' => $request['rubroEdit']['descripcion']
            ]
        );
        if($rubro){
            return "OK";
        }else{
            return "FAIL";
        }
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
        $eliminar=Rubro::where('id',$id)->delete();
        if($eliminar){
            return "OK";
        }else{
            return "FAIL";
        }
    }
}
