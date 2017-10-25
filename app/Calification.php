<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calification extends Model
{
    protected  $table = "t_califications";

    protected $fillable = ['id_t_materias','id_t_usuarios','calificacion'];
}
