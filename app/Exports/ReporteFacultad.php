<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;

class ReporteFacultad implements FromArray
{
    /**
    * @return \Illuminate\Support\Arr 
    */
    public function array(): array
    {
        $user = \Auth::user();
        $user = $user->user;
        $encargado = \DB::select("SELECT idFacultad as id FROM persona where DNI='$user'");
        foreach ($encargado as $key) {
            $id=$key->id;
        }
        $resultado = \DB::select("CALL `SP_ReporteFacultad`($id);");
        $resultadoArray[] = array('DNI','Nombre','Telefono','Correo','AnioNacimiento',
            'Genero','pais','departamento','DistritoCiudad','Dirección','estadocivil',
            'CantHijos','discapacidad','facultad','escuela','Ingreso','egreso','AnioBachiller','AnioTitulo');
        foreach ($resultado as $result) 
        {
            $resultadoArray[] = array(
                'DNI' => $result->DNI,
                'Graduado' => $result->Nombre,
                'Telefono' => $result->Telefono,
                'Correo' => $result->Correo,
                'AnioNacimiento' => $result->AnioNacimiento,
                'Genero' => $result->Genero,
                'Pais' => $result->pais,
                'Departamento' => $result->departamento,
                'Distrito' => $result->DistritoCiudad,
                'Direccion' => $result->Dirección,
                'Estado Civil' => $result->estadocivil,
                'Hijos' => $result->CantHijos,
                'Discapacidad' => $result->discapacidad,
                'Facultad' => $result->facultad,
                'Escuela' => $result->escuela,
                'Ingreso' => $result->egreso,
                'Egreso' => $result->egreso,
                'Bachiller' => $result->AnioBachiller,
                'Titulo' => $result->AnioTitulo,
            );
        } 
        return $resultadoArray;
    }
}