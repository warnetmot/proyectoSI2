<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('id_compra')->autoIncrement()->unicade();

            $table->unsignedBigInteger('id_proveedor');

            $table->date('fecha_compra');
            $table->decimal('total', 10, 2);

            $table->timestamps();

            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
