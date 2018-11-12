<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ExcelReporteEscuela implements FromArray
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Arr 
    */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function array(): array
    {
        $resultado = \DB::select("SELECT g.DNI, g.Nombre, g.Telefono, g.Correo, g.AnioNacimiento, g.Genero, p.Nombre as pNombre,
                                    ed.Nombre as deNombre, g.DistritoCiudad, g.Dirección, ec.descripcion, g.CantHijos, d.descripcion as dDescripcion, 
                                    g.Ingreso, g.egreso, g.AnioBachiller, g.AnioTitulo
                                    from graduado g
                                    inner join departamentoestado ed ON ed.DepartamentoEstado = g.EstadoDepartamento
                                    inner join estadocivil ec ON ec.id = g.EstadoCivil
                                    inner join discapacidad d ON d.id = g.Discapacidad
                                    inner join pais  p on p.idPais = g.PaisResidencia
                                    where g.Escuela=".$this->id);

        $resultadoArray[] = array('DNI','Nombres','Telefono','Correo','Fecha Nacimiento','Genero','Pais','Departamento',
                                'Distrito/Ciudad','Direccion','Estado Civil','N° Hijos','Discapacidad','Fecha Ingreso','Fecha Egreso',
                                'Año Bachiller','Año Titulo');

        foreach ($resultado as $result)
        {
            $resultadoArray[] = array(
                'DNI' => $result->DNI,
                'Nombres' => $result->Nombre,
                'Telefono' => $result->Telefono,
                'Correo' => $result->Correo,
                'Fecha Nacimiento' => $result->AnioNacimiento,
                'Genero'=>$result->Genero,
                'Pais'=>$result->pNombre,
                'Departamento'=>$result->deNombre,
                'Distrito/Ciudad'=>$result->DistritoCiudad,
                'Direccion'=>$result->Dirección,
                'Estado Civil'=>$result->descripcion,
                'N° Hijos'=>$result->CantHijos,
                'Discapacidad'=>$result->dDescripcion,
                'Fecha Ingreso'=>$result->Ingreso,
                'Fecha Egreso'=>$result->egreso,
                'Año Bachiller'=>$result->AnioBachiller,
                'Año Titulo'=>$result->AnioTitulo
            );
        } 
        return $resultadoArray;
    }
}
