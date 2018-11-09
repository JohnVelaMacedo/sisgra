<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;

class ReporteGraduados implements FromArray
{
    /**
    * @return \Illuminate\Support\Arr 
    */
    public function array(): array
    {
        $resultado = \DB::select("CALL `SP_MostrarTodos`()");
        $resultadoArray[] = array('Facultad','Escuela','Grado','Nombre','Año Bachiller');
        foreach ($resultado as $result) 
        {
            $resultadoArray[] = array(
                'Facultad' => $result->facu,
                'Escuela' => $result->escuela,
                'Grado' => $result->Descripcion,
                'Nombre' => $result->Nombre,
                'Bachiller' => $result->AnioBachiller
            );
        } 
        return $resultadoArray;
    }
}
