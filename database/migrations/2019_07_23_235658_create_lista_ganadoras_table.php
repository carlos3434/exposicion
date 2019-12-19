<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaGanadorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_ganadoras', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->date('fecha_registro');
            $table->date('fecha_instalacion');
            $table->string('periodo')->nullable();
            $table->string('credential_comite_electoral')->nullable();
            $table->unsignedBigInteger('cargo_postulante_id')->index();
            $table->foreign('cargo_postulante_id')->references('id')->on('cargo_postulantes')->onDelete('cascade');
            
            $table->unsignedBigInteger('departamento_id')->index();

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
        Schema::dropIfExists('lista_ganadoras');
    }
}
