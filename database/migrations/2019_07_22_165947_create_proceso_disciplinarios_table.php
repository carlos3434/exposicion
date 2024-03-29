<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoDisciplinariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_disciplinarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_registro');
            $table->text('descripcion')->nullable();
            $table->string('documento');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('monto_multa',5)->nullable();

            $table->integer('persona_id');
            $table->string('url_documento')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('sancion_id')->index();
            $table->foreign('sancion_id')->references('id')->on('sancions')->onDelete('cascade');
            $table->boolean('is_apelacion')->default(0);
            $table->unsignedBigInteger('tipo_proceso_disciplinario_id')->index();
            $table->foreign('tipo_proceso_disciplinario_id')->references('id')->on('tipo_proceso_disciplinarios')->onDelete('cascade');

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
        Schema::dropIfExists('proceso_disciplinarios');
    }
}
