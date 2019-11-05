<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('departamento_id')->index();
            $table->foreign('departamento_id')->references('id')->on('ubigeos')->onDelete('cascade');

            $table->date('fecha_adquisicion');

            $table->unsignedBigInteger('responsable_id')->index();
            $table->foreign('responsable_id')->references('id')->on('responsables')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_inventario_id')->index();
            $table->foreign('tipo_inventario_id')->references('id')->on('tipo_inventario')->onDelete('cascade');

            //1: MUEBLES Y ENSERES    , 2:EQUIPOS DE COMPUTO

            $table->string('codigo', 50)->nullable();
            $table->string('descripcion', 50)->nullable();
            $table->string('cantidad', 5)->nullable();
            $table->string('marca', 50)->nullable();
            $table->string('modelo', 50)->nullable();
            $table->string('serie', 50)->nullable();
            $table->string('caracteristica', 50)->nullable();
            $table->string('ubicacion', 50)->nullable();
            $table->string('vida_util', 50)->nullable();

            $table->unsignedBigInteger('estado_inventario_id')->index();
            $table->foreign('estado_inventario_id')->references('id')->on('estado_inventario')->onDelete('cascade');

            $table->decimal('valor_activo')->default(0);

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
        Schema::dropIfExists('inventarios');
    }
}
