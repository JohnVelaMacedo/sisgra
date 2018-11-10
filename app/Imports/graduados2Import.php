<?php

namespace App\Imports;

use App\Graduado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

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
            '0' => Rule::in(['patrick@maatwebsite.nl']),
            '1' => Rule::in(['patrick@maatwebsite.nl']),
            '2' => Rule::in(['patrick@maatwebsite.nl']),
            '3' => Rule::in(['patrick@maatwebsite.nl']),
            '4' => Rule::in(['patrick@maatwebsite.nl']),
            '5' => Rule::in(['patrick@maatwebsite.nl']),
            '6' => Rule::in(['patrick@maatwebsite.nl']),
            '7' => Rule::in(['patrick@maatwebsite.nl']),
            '8' => Rule::in(['patrick@maatwebsite.nl']),
            '9' => Rule::in(['patrick@maatwebsite.nl']),
            '10' => Rule::in(['patrick@maatwebsite.nl']),
            '11' => Rule::in(['patrick@maatwebsite.nl']),
            '12' => Rule::in(['patrick@maatwebsite.nl']),
            '13' => Rule::in(['patrick@maatwebsite.nl']),
            '14' => Rule::in(['patrick@maatwebsite.nl']),
            '15' => Rule::in(['patrick@maatwebsite.nl']),
            '16' => Rule::in(['patrick@maatwebsite.nl']),
            '17' => Rule::in(['patrick@maatwebsite.nl']),
            '18' => Rule::in(['patrick@maatwebsite.nl']),

             // Above is alias for as it always validates in batches
             '*.1' => Rule::in(['patrick@maatwebsite.nl']),
        ];
    }

}
