<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    public $table = 'tipousuario';
    protected $fillable = ['id', 'descripcion'];
}
