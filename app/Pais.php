<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public $table = 'pais';
    protected $fillable = ['idPais', 'Nombre'];
}
