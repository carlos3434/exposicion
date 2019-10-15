<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepto_pago', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('unidad_medida');//ZZ
            $table->string('codigo');
            $table->string('codigo_sunat');
            $table->decimal('precio')->default(0);
            $table->string('tipo_afecta_igv',5)->default(30);
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
        Schema::dropIfExists('concepto_pago');
    }
}
