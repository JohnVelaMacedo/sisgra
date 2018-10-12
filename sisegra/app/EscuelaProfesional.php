<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscuelaProfesional extends Model
{
    public $table = 'escuelaprofesional';
    protected $fillable = ['idEscuela', 'idFacultad', 'Nombre'];
}
