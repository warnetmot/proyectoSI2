<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id()->autoIncrement()->unicade();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio_unitario', 8, 2);
            $table->integer('stock')->default(0);
            $table->string('categoria');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
