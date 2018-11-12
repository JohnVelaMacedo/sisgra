<?php

namespace App\Imports;

use App\EscuelaProfesional;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class graduadosImport implements ToModel, WithHeadingRow
{ 
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EscuelaProfesional([
            'DNI'               =>$row['DNI'],
            'Nombre'            =>$row['Nombre'],
            'Telefono'          =>$row['Telefono'],
            'Correo'            =>$row['Correo'],
            'AnioNacimiento'    =>$row['AnioNacimiento'],
            'Genero'            =>$row['Genero'],
            'PaisResidencia'    =>$row['PaisResidencia'],
            'EstadoDepartamento'=>$row['EstadoDepartamento'],
            'DistritoCiudad'    =>$row['DistritoCiudad'],
            'Direccion'         =>$row['Direccion'],
            'EstadoCivil'       =>$row['EstadoCivil'],
            'CantHijos'         =>$row['CantHijos'],
            'Discapacidad'      =>$row['Discapacidad'],
            'Facultad'          =>$row['Facultad'],
            'Escuela'           =>$row['Escuela'],
            'Ingreso'           =>$row['Ingreso'],
            'egreso'            =>$row['egreso'],
            'AnioBachiller'     =>$row['AnioBachiller'],
            'AnioTitulo'        =>$row['AnioTitulo'],
        ]);
    }
}
