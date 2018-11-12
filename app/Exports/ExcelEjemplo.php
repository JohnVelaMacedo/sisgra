<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;

class ExcelEjemplo implements FromArray
{
    /**
    * @return \Illuminate\Support\Arr 
    */
    public function array(): array
    {
        //$resultado = \DB::select("CALL `SP_MostrarTodos`()");
        $resultadoArray[] = array('DNI(numero)','Nombres y Apellidos','Telefono','Correo','FechaNacimiento(año-mes-dia)','Genero(M o F)','Pais residencia(numerocodigo o 0)','EstadoDepartamento(numerocodigo o 0)','distritociudad(numerocodigo)','direccion','estadoCivil(numerocodigo)','cantidadhijos','discapacidad(0)','facultad(numeroCodigo)','escuela(numeroCodigo)','fechaIngreso(año-mes-dia)','fechaEgreso(año-mes-dia)','añoBachiller(año)','añoTitulo(año o 0000 si no es titulado)','nombreEmpresa','urlEmpresa','telefonoEmpresa','rubro(numeroCodigo)','sector(numeroCodigo)');
        // foreach ($resultado as $result) 
        // {
        //     $resultadoArray[] = array(
        //         'Facultad' => $result->facu,
        //         'Escuela' => $result->escuela,
        //         'Grado' => $result->Descripcion,
        //         'Nombre' => $result->Nombre,
        //         'Bachiller' => $result->AnioBachiller
        //     );
        // } 
        return $resultadoArray;
    }
}
