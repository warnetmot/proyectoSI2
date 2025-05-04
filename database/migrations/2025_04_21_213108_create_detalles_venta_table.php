<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesVentaTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_venta', function (Blueprint $table) {
            $table->id('id_detalle')->autoIncrement()->unicade();

            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_producto');

            $table->integer('cantidad');
            $table->decimal('precio_unitario', 8, 2);

            $table->timestamps();

            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_venta');
    }
}


