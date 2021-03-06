<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApelacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apelacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_registro');
            $table->string('resolucion');
            $table->string('resolucion_nacional')->nullable();

            $table->integer('persona_id');
            $table->integer('updated_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->boolean('is_titular');
            $table->boolean('is_apelacion');
            $table->string('representanteNombres')->nullable();
            $table->string('representanteApellidoPaterno')->nullable();
            $table->string('representanteApellidoMaterno')->nullable();
            $table->string('url_documento')->nullable();
            $table->string('url_documento_nacional')->nullable();
            $table->unsignedBigInteger('documento_id')->index();
            $table->foreign('documento_id')->references('id')->on('proceso_disciplinarios')->onDelete('cascade');
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
        Schema::dropIfExists('apelacions');
    }
}
