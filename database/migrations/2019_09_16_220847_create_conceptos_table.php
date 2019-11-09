<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('unidad_medida')->nullable();//ZZ
            $table->string('codigo');
            $table->string('codigo_sunat')->nullable();
            $table->decimal('precio')->default(0);
            $table->string('tipo_afecta_igv',5)->default(30);
            $table->boolean('tipo')->default(0);//ingreso 0, egreso 1
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
        Schema::dropIfExists('conceptos');
    }
}
