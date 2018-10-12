<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduado extends Model
{
    public $table = 'graduado';
    protected $fillable = [
        'DNI',
        'Nombre',
        'Telefono',
        'Correo',
        'AnioNacimiento',
        'Genero',
        'PaisResidencia',
        'EstadoDepartamento',
        'DistritoCiudad',
        'Dirección',
        'EstadoCivil',
        'CantHijos',
        'Discapacidad',
        'Facultad',
        'Escuela',
        'Ingreso',
        'egreso',
        'AnioBachiller',
        'AnioTitulo'
    ];
}
