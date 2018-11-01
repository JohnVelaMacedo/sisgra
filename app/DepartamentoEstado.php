<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartamentoEstado extends Model
{
    public $table = 'departamentoestado';
    protected $fillable = ['DepartamentoEstado', 'idPais', 'Nombre'];
}
