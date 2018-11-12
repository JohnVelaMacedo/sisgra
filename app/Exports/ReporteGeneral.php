<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;

class ReporteGeneral implements FromArray
{
    /**
    * @return \Illuminate\Support\Arr 
    */
    public function array(): array
    {
        $resultado = \DB::select("CALL `SP_MostrarCantidadPorEscuelaAnio`()");
        $resultadoArray[] = array('Bachiller','Facultad','Escuela','Cantidad');
        foreach ($resultado as $result) 
        {
            $resultadoArray[] = array(
                'Bachiller' => $result->bach,
                'Facultad' => $result->facu,
                'Escuela' => $result->esc,
                'Cantidad' => $result->cant
            );
        } 
        return $resultadoArray;
    }
}