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
            $table->date('fecha_registro')->nullable();

            $table->integer('tipo_documento_identidad_id');
            $table->string('numero_documento_identidad',11);
            $table->string('nacionalidad_id');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombres');
            $table->string('ruc',11)->nullable();
            $table->date('fecha_nacimiento');
            $table->integer('estado_civil_id');

            $table->string('conyuge_apellido_paterno')->nullable();
            $table->string('conyuge_apellido_materno')->nullable();
            $table->string('conyuge_nombres')->nullable();
            $table->string('numero_hijos')->nullable();

            $table->unsignedBigInteger('departamento_id')->index();
            $table->foreign('departamento_id')->references('id')->on('ubigeos')->onDelete('cascade');
            $table->unsignedBigInteger('distrito_id')->index();
            $table->foreign('distrito_id')->references('id')->on('ubigeos')->onDelete('cascade');
            $table->unsignedBigInteger('provincia_id')->index();
            $table->foreign('provincia_id')->references('id')->on('ubigeos')->onDelete('cascade');

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
            //$table->date('fecha_registro_consejo')->nullable();
            $table->string('url_cv')->nullable();
            $table->boolean('is_voluntario')->nullable();
            $table->string('grupo_sanguineo')->nullable();

            $table->integer('departamento_colegiado_id')->nullable();

            $table->string('numero_operacion')->nullable();
            $table->string('banco_operacion')->nullable();
            $table->date('fecha_operacion')->nullable();
            $table->string('monto_operacion')->default(0);

            $table->date('fecha_inscripcion')->nullable();
            $table->date('fecha_presentacion_solicitud')->nullable();
            $table->date('fecha_sesion')->nullable();//fecha a evaluar la solicitud
            $table->date('fecha_llegada_solicitud')->nullable();
            $table->date('fecha_registro_carnet')->nullable();
            $table->date('fecha_aprobacion_consejo')->nullable();
            $table->date('fecha_emision_carnet')->nullable();
            $table->date('fecha_caducidad_carnet')->nullable();
            $table->date('fecha_juramentacion')->nullable();
            
            $table->date('fecha_solicitud_faf')->nullable();
            $table->date('fecha_recepcion_faf')->nullable();
            $table->date('fecha_firma_consejo')->nullable();

            $table->boolean('is_pago_colegiatura')->default(0);
            $table->boolean('is_licencia')->default(0);
            $table->boolean('is_inscripcion')->default(0);
            $table->string('estado_solicitud')->nullable();//Aprovado / Denegado
            $table->boolean('is_solicitud')->default(0);
            $table->boolean('is_carnet')->default(0);
            $table->boolean('is_resuelve_consejo')->default(0);
            $table->boolean('is_juramentacion_programada')->default(0);
            $table->boolean('is_juramentacion_validada')->default(0);

            $table->boolean('is_pago_cuota_mensual')->default(0);

            $table->boolean('is_habilitado')->default(0);//registrar cuando se ingresa el campo is juramentacion.
            $table->integer('numero_incidencias')->default(0);
            $table->integer('numero_procesos_disciplinarios')->default(0);
            $table->integer('estado_registro_colegiado_id')->default(1);

            $table->date('fecha_colegiatura')->nullable();
            $table->date('fecha_resuelve_consejo')->nullable();
            $table->string('url_foto')->nullable();
            $table->integer('estado_cuenta_sistema_id')->default(1);

            $table->string('ultimo_mes_pago')->nullable();
            $table->string('numero_meses_deuda')->default(0);
            $table->string('total_deuda')->default(0);// monto deuda total
            $table->string('numero_meses_adelanto')->default(0);
            $table->string('total_adelanto')->default(0);
            $table->string('numero_meses_aportado')->default(0);//numero meses aportado de cuota
            $table->string('total_aportado')->default(0);//mensualidades done
            $table->string('total_faf')->default(0);//25% de cada cuota
            $table->string('total_departamental')->default(0);//55% de cada cuota
            $table->string('total_consejo')->default(0);//20% de cada cuota
            $table->string('multa_pendiente')->default(0);
            $table->string('multa_pagadas')->default(0);
            $table->string('monto_inscripcion')->default(0);

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
