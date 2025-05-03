<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('id_reserva')->autoIncrement()->unicade(); 
       
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_artista');

            
            $table->date('fecha_reserva');
            $table->time('hora_reserva');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');

            $table->timestamps();
  
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_artista')->references('id_artista')->on('artistas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
};

