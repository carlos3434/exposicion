<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ruc')->default('');
            $table->string('nombre_comercial')->default('');
            $table->string('certificado_digital')->default('');
            $table->string('razon_social')->default('');
            $table->string('direccion_web')->default('');
            $table->string('telefono')->default('');
            $table->string('email')->default('');
            $table->string('direccion')->default('');
            $table->string('logo')->default('');

            $table->unsignedBigInteger('ubigeo_id')->index();
            $table->foreign('ubigeo_id')->references('id')->on('ubigeos')->onDelete('cascade');

            $table->string('user_sunat')->default('');
            $table->string('password_sunat')->default('');
            $table->integer('entorno')->default(0);//beta produccion

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
        Schema::dropIfExists('empresas');
    }
}
