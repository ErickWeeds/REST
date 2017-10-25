<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = "t_alumnos";

    public function calificaciones(){
        return $this->hasMany('App\Calification');
    }
}
