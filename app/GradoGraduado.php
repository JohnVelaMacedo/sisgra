<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradoGraduado extends Model
{
    public $table = 'gradograduado';
    protected $fillable = ['id', 'Grado', 'idGraduado', 'anioGraduacion'];
    public $timestamps = false;
}
