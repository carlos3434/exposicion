<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadoEleccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_eleccions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('fecha_registro');
            $table->string('lista_ganadora')->nullable();
            $table->string('numero_votantes')->nullable();
            $table->string('numero_novotantes')->nullable();
            $table->string('numero_votos')->nullable();
            $table->text('observacion')->nullable();
            $table->unsignedBigInteger('departamento_id')->index();

            $table->integer('updated_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();


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
        Schema::dropIfExists('resultado_eleccions');
    }
}
