<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    public $table = 'facultad';
    protected $fillable = ['id', 'Nombre'];
}
