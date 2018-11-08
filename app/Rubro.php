<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    public $table = 'rubro';
    protected $fillable = ['id', 'descripcion'];
    public $timestamps = false;
}
