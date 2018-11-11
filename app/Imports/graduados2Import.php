<?php

namespace App\Imports;

use App\Graduado;
use App\Entidad;
use App\User;
use App\GradoGraduado;
use App\EmpresaGraduado;
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
        if (is_null($row[18]) || empty($row[18])) {
            $row[18]="0000";
            $grado_graduado = 1;
            
        } else {
            $grado_graduado = 2;
        }
        $g=new Graduado([
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
        
        $u=new User([
            'id'=>$row[0],
            'user'=>$row[0],
            'password'=>bcrypt('Inicio'.$row[0]),
            'tipo'=>4,
            'estado'=>0,
            'remember_token'=>null,
        ]);

        $gg=new GradoGraduado([
            'id'    =>null,
            'Grado' =>$grado_graduado,
            'idGraduado'=>$row[0],
            'anioGraduacion'=>$row[17],
        ]);
        $entidad = Entidad::updateOrCreate(
            ['id' => null],
            [
                'descripcion' => $row[19],
                'idRubro' => $row[22],
                'telefono' => $row[21],
                'web' => $row[20],
                'idSector' => $row[23]
            ]
        );
        $e=new Entidad([
            'id' =>null,
            'descripcion'=>$row[19],
            'idRubro'=>$row[22],
            'telefono'=>$row[21],
            'web'=>$row[20],
            'idSector'=>$row[23],
        ]);
        $eg=new EmpresaGraduado([
            'id'=>null,
            'idGraduado'=>$row[0],
            'idEntidad'=>$entidad->id,
        ]);

        return [ $g,$gg,$u,$eg];
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
            'A' => Rule::in(['patrick@maatwebsite.nl']),

        ];
    }

}
