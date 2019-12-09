<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_notas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('codigo')->nullable();
            $table->string('codigo_sunat')->nullable();
            $table->boolean('tipo')->default(0);//1: credito, 2 debito
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
        Schema::dropIfExists('tipo_notas');
    }
}
