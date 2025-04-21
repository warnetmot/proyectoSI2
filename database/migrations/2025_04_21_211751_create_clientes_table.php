<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente'); 
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique(); 
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_registro');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}

