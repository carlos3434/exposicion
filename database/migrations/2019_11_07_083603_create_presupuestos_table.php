<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('departamento_id')->index();
            $table->foreign('departamento_id')->references('id')->on('ubigeos')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_presupuesto_id')->index();//GASTOS DE PERSONAL , TELEFONO etc
            //$table->foreign('tipo_presupuesto_id')->references('id')->on('tipo_presupuesto')->onDelete('cascade');

            $table->unsignedBigInteger('concepto_id')->index()->default(0);

            $table->string('monto',10)->default('0');

            $table->date('mes');

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
        Schema::dropIfExists('presupuestos');
    }
}
