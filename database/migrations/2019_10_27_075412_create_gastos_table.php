<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_registro');
            
            $table->integer('updated_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();

            $table->unsignedBigInteger('persona_id')->index();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->unsignedBigInteger('cargo_id')->index();
            $table->foreign('cargo_id')->references('id')->on('cargo_postulantes')->onDelete('cascade');
            $table->unsignedBigInteger('departamento_id')->index();
            $table->foreign('departamento_id')->references('id')->on('ubigeos')->onDelete('cascade');

            $table->string('motivo',50);
            $table->string('origen',50);
            $table->string('destino',50);
            $table->string('retorno',50);
            $table->date('fecha_salida',50);
            $table->date('fecha_retorno',50);
            $table->string('monto_recibido',10);
            $table->string('monto_retenido',10);
            $table->string('devolucion',10);
            $table->string('pendiente_rendicion',10);
            $table->string('total',10);

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
        Schema::dropIfExists('gastos');
    }
}
