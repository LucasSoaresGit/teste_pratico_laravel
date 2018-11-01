<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    protected $table = 'horarios';
    public $timestamps = true;
    protected $fillable = ['horario']; 
}
