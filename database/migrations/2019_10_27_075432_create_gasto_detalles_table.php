<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('gasto_id')->index();
            $table->foreign('gasto_id')->references('id')->on('gastos')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_gasto_id')->index();
            $table->foreign('tipo_gasto_id')->references('id')->on('tipo_gastos')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_documento_pago_id')->index();
            $table->foreign('tipo_documento_pago_id')->references('id')->on('tipo_documento_pago')->onDelete('cascade');


            $table->date('fecha');
            $table->date('fecha_fin');
            $table->string('detalle',50);//ruta
            $table->string('ruc',11);
            $table->string('razon_social',50);
            $table->string('serie',50);
            $table->string('numero',50);
            $table->string('monto',50);
            $table->string('salida',50);
            $table->string('llegada',50);
            $table->string('lugar',50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gasto_detalles');
    }
}
