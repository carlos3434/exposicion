<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->decimal('monto')->default(0);
            $table->boolean('is_fraccion');
            $table->date('fecha_vencimiento')->nullable();
            //$table->string('numero_fraccion')->nullable();

            $table->unsignedBigInteger('pago_id')->nullable();
            $table->foreign('pago_id')->references('id')->on('pagos');

            $table->unsignedBigInteger('estado_pago_id')->index();
            $table->foreign('estado_pago_id')->references('id')->on('estado_pagos')->onDelete('cascade');

            $table->unsignedBigInteger('concepto_id')->index();
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onDelete('cascade');

            $table->unsignedBigInteger('persona_id')->index();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');

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
        Schema::dropIfExists('pagos');
    }
}
