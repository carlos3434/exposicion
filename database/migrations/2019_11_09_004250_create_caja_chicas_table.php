<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajaChicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caja_chica', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('fecha');
            $table->unsignedBigInteger('concepto_id')->index();
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onDelete('cascade');

            $table->unsignedBigInteger('departamento_id')->index();
            $table->foreign('departamento_id')->references('id')->on('ubigeos')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_documento_pago_id')->index();
            $table->foreign('tipo_documento_pago_id')->references('id')->on('tipo_documento_pago')->onDelete('cascade');

            $table->string('numero_documento_pago')->nullable();
            $table->string('beneficiario')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('monto')->default('0');

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
        Schema::dropIfExists('caja_chica');
    }
}
