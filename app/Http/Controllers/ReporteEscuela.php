<?php

namespace App\Http\Controllers;

use App\Exports\ExcelEjemplo;
use App\Exports\ExcelReporteEscuela;
use Illuminate\Http\Request;
use App\Persona;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;   

class ReporteEscuela extends Controller
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
        //
    }

    public function excelEjemplo()
    {        
       return Excel::download(new ExcelEjemplo, 'formato.xlsx');
    }

    public function excel()
    {
        $user = \Auth::user();
        $user = $user->id;
        $p=Persona::where('DNI',$user)->first();
       return Excel::download(new ExcelReporteEscuela($p->idEscuela), 'reporteEscuela.xlsx');
    } 

    public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $query = $this->getDatosEscuela();

        $pdf = PDF::loadView('reporteEscuelapdf', $query)->setPaper('a4', 'landscape');

        return $pdf->download('listado.pdf');
    }

    public function getDatosEscuela()
    {
        $user = \Auth::user();
        $user = $user->id;
        $p=Persona::where('DNI',$user)->first();
        $resultado = \DB::select("SELECT g.DNI, g.Nombre, g.Telefono, g.Correo, g.AnioNacimiento, g.Genero, p.Nombre as pNombre,
                                ed.Nombre as deNombre, g.DistritoCiudad, g.Dirección, ec.descripcion, g.CantHijos,
                                 d.descripcion as dDescripcion, 
                                g.Ingreso, g.egreso, g.AnioBachiller, g.AnioTitulo
                                from graduado g
                                inner join departamentoestado ed ON ed.DepartamentoEstado = g.EstadoDepartamento
                                inner join estadocivil ec ON ec.id = g.EstadoCivil
                                inner join discapacidad d ON d.id = g.Discapacidad
                                inner join pais  p on p.idPais = g.PaisResidencia
                                where g.Escuela=".$p->idEscuela);

        return compact('resultado');
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
