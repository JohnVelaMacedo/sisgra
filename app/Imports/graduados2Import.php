<?php

namespace App\Imports;

use App\Graduado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class graduados2Import implements ToModel, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Graduado([
            'DNI'               =>$row[0],
            'Nombre'            =>$row[1],
            'Telefono'          =>$row[2],
            'Correo'            =>$row[3],
            'AnioNacimiento'    =>$row[4],
            'Genero'            =>$row[5],
            'PaisResidencia'    =>$row[6],
            'EstadoDepartamento'=>$row[7],
            'DistritoCiudad'    =>$row[8],
            'Dirección'         =>$row[9],
            'EstadoCivil'       =>$row[10],
            'CantHijos'         =>$row[11],
            'Discapacidad'      =>$row[12],
            'Facultad'          =>$row[13],
            'Escuela'           =>$row[14],
            'Ingreso'           =>$row[15],
            'egreso'            =>$row[16],
            'AnioBachiller'     =>$row[17],
            'AnioTitulo'        =>$row[18],
        ]);
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function rules(): array
    {
        return [
            'DNI' => Rule::in(['patrick@maatwebsite.nl']),
            'Nombre' => Rule::in(['patrick@maatwebsite.nl']),
            'Telefono' => Rule::in(['patrick@maatwebsite.nl']),
            'Correo' => Rule::in(['patrick@maatwebsite.nl']),
            'AnioNacimiento' => Rule::in(['patrick@maatwebsite.nl']),
            'Genero' => Rule::in(['patrick@maatwebsite.nl']),
            'PaisResidencia' => Rule::in(['patrick@maatwebsite.nl']),
            'EstadoDepartamento' => Rule::in(['patrick@maatwebsite.nl']),
            'DistritoCiudad' => Rule::in(['patrick@maatwebsite.nl']),
            'Dirección' => Rule::in(['patrick@maatwebsite.nl']),
            'EstadoCivil' => Rule::in(['patrick@maatwebsite.nl']),
            'CantHijos' => Rule::in(['patrick@maatwebsite.nl']),
            'Discapacidad' => Rule::in(['patrick@maatwebsite.nl']),
            'Facultad' => Rule::in(['patrick@maatwebsite.nl']),
            'Escuela' => Rule::in(['patrick@maatwebsite.nl']),
            'Ingreso' => Rule::in(['patrick@maatwebsite.nl']),
            'egreso' => Rule::in(['patrick@maatwebsite.nl']),
            'AnioBachiller' => Rule::in(['patrick@maatwebsite.nl']),
            'AnioTitulo' => Rule::in(['patrick@maatwebsite.nl']),

        ];
    }

}
