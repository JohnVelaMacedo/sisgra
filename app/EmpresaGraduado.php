<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaGraduado extends Model
{
    public $table = 'empresa_graduado';
    protected $fillable = ['id', 'idGraduado', 'idEntidad'];
    public $timestamps = false;
}
