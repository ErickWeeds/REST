<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('califications', function (Blueprint $table) {
            $table->increments('id_t_calificaciones');
            $table->integer('id_t_materias')->unsigned();
            $table->integer('id_t_usuarios')->unsigned();
            $table->float('calificacion',10,2);
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('id_t_materias')->references('t_materias')->on('id_t_materias');
            $table->foreign('id_t_usuarios')->references('t_alumnos')->on('id_t_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('califications');
    }
}
