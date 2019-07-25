<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_registro');


            $table->string('dni',11);
            $table->string('nacionalidad_id');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombres');
            $table->date('fecha_nacimiento');
            $table->integer('estado_civil_id');

            $table->string('conyuge_apellido_paterno')->nullable();
            $table->string('conyuge_apellido_materno')->nullable();
            $table->string('conyuge_nombres')->nullable();
            $table->string('numero_hijos')->nullable();

            $table->integer('departamento_id');
            $table->integer('provincia_id');
            $table->integer('distrito_id');
            $table->string('direccion');

            $table->string('telefono_fijo')->nullable();
            $table->string('celular_uno')->nullable();
            $table->string('celular_dos')->nullable();
            $table->string('email_uno')->nullable();
            $table->string('email_dos')->nullable();

            $table->integer('universidad_procedencia_id')->nullable();
            $table->date('fecha_bachiller')->nullable();
            $table->date('fecha_titulacion')->nullable();

            $table->integer('especialidad_posgrado_id')->nullable();
            $table->integer('area_ejercicio_profesional_id')->nullable();

            $table->string('nombre_centro_laboral')->nullable();
            $table->string('direccion_centro_laboral')->nullable();
            $table->string('telefono_centro_laboral')->nullable();

            $table->string('numero_cmvp')->nullable();
            $table->date('fecha_registro_consejo')->nullable();
            $table->string('url_cv')->nullable();
            $table->boolean('is_voluntario')->nullable();
            $table->string('grupo_sanguineo')->nullable();
            
            $table->unsignedBigInteger('departamento_colegiado_id')->index();
            $table->foreign('departamento_colegiado_id')->references('id')->on('departamentos')->onDelete('cascade');
            
            $table->boolean('is_habilitado')->nullable();
            $table->boolean('is_incidencia')->nullable();
            $table->boolean('is_carnet')->nullable();
            $table->integer('estado_registro_id')->nullable();

            $table->date('fecha_colegiatura')->nullable();
            $table->date('fecha_aprovacion_consejo')->nullable();
            $table->string('url_foto')->nullable();
            $table->integer('estado_cuenta_id')->nullable();

            $table->string('ultimo_mes_pago')->nullable();
            $table->string('numero_meses_deuda')->nullable();
            $table->string('total_deuda')->nullable();// mensualidades pendientes
            $table->string('total_aportado')->nullable();//mensualidades done
            $table->string('total_faf')->nullable();
            $table->string('total_adelanto')->nullable();
            $table->string('total_departamental')->nullable();
            $table->string('total_consejo')->nullable();
            $table->string('multa_pendiente')->nullable();
            $table->string('multa_pagadas')->nullable();



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
        Schema::dropIfExists('personas');
    }
}
