<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasTable extends Migration
{
    public function up()
    {
        Schema::create('artistas', function (Blueprint $table) {
            $table->id('id_artista'); 
            $table->string('nombre');
            $table->string('apellido');
            $table->string('especialidad');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('artistas');
    }
}

