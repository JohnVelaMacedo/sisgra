<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    public $table = 'discapacidad';
    protected $fillable = ['id', 'descripcion'];
}
