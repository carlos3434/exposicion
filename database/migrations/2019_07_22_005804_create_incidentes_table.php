<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_registro');
            $table->text('descripcion')->nullable();
            $table->string('documento');
            $table->unsignedBigInteger('tipo_incidente_id')->index();
            $table->foreign('tipo_incidente_id')->references('id')->on('tipo_incidentes')->onDelete('cascade');

            $table->integer('persona_id');
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
        Schema::dropIfExists('incidentes');
    }
}
