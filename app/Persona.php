<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $table="persona";
    protected $fillable=['DNI','Nombre','Apellidos','Telefono','Direccion','idFacultad','idEscuela','Correo','estado'];
}
