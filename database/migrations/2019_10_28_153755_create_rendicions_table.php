<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRendicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendicions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('periodo',50)->nullable();
            $table->integer('tipo_rendicion_id');//1: Compra, 2:Gasto
            $table->date('fecha');
            $table->unsignedBigInteger('tipo_documento_pago_id')->index();
            $table->foreign('tipo_documento_pago_id')->references('id')->on('tipo_documento_pago')->onDelete('cascade');
            $table->string('serie',50)->nullable();
            $table->string('numero',50)->nullable();

            $table->unsignedBigInteger('departamento_id')->index();
            $table->foreign('departamento_id')->references('id')->on('ubigeos')->onDelete('cascade');

            $table->unsignedBigInteger('responsable_id')->index();
            $table->foreign('responsable_id')->references('id')->on('responsables')->onDelete('cascade');

            $table->integer('tipo_documento_identidad_id');
            $table->string('numero_documento_identidad',11);

            $table->string('razon_social',50)->nullable();

            $table->decimal('base')->default(0);
            $table->decimal('igv')->default(0);
            $table->decimal('monto_no_gravado')->default(0);
            $table->decimal('importe_total')->default(0);

            $table->string('descripcion',100)->nullable();

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
        Schema::dropIfExists('rendicions');
    }
}
