<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    public $table = 'entidad';
    protected $fillable = ['id', 'descripcion', 'idRubro', 'telefono', 'web', 'idSector'];
    public $timestamps = false;
}
