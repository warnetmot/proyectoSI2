<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesionesTable extends Migration
{
    public function up()
    {
        Schema::create('sesiones', function (Blueprint $table) {
            $table->id('id_sesion'); 

            $table->unsignedBigInteger('id_reserva');

            $table->date('fecha_sesion');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->text('descripcion_tatuaje');
            $table->string('imagen_referencia')->nullable(); 
            $table->decimal('costo', 8, 2)->default(0);
            $table->enum('estado', ['completada', 'en progreso', 'cancelada'])->default('en progreso');

            $table->timestamps();

            $table->foreign('id_reserva')->references('id_reserva')->on('reservas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesiones');
    }
}

