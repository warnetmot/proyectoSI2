<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesComprasTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_compras', function (Blueprint $table) {
            $table->id('id_detalle')->autoIncrement()->unicade(); 

            $table->unsignedBigInteger('id_compra');
            $table->unsignedBigInteger('id_producto');

            $table->integer('cantidad');
            $table->decimal('precio_unitario', 8, 2);

            $table->timestamps();

            $table->foreign('id_compra')->references('id_compra')->on('compras')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_compras');
    }
}
