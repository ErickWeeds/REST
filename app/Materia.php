<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = "t_materias";

    public function calificaciones(){
        $this->hasMany('App\Calification');
    }
}
