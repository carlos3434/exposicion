<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('persona_id')->index();
            $table->unsignedBigInteger('tipo_documento_pago_id')->index();
            $table->foreign('tipo_documento_pago_id')->references('id')->on('tipo_documento_pago')->onDelete('cascade');

            $table->unsignedBigInteger('serie_id')->index();
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');

            $table->string('numero');

            $table->unsignedBigInteger('cliente_id')->index();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->string('tipo_moneda');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->unsignedBigInteger('tipo_operacion_id');//venta interna
            $table->foreign('tipo_operacion_id')->references('id')->on('tipo_operacion')->onDelete('cascade');

            $table->decimal('descuento_global')->default(0);
            $table->decimal('descuento_total')->default(0);
            $table->decimal('monto_exogerado')->default(0);
            $table->decimal('monto_inafecta')->default(0);
            $table->decimal('monto_gravada')->default(0);
            $table->decimal('monto_gratuito')->default(0);
            $table->decimal('igv_total')->default(0);
            //$table->decimal('monto_total')->default(0);
            $table->decimal('valor_venta')->default(0);
            $table->decimal('monto_importe_total_venta')->default(0);

            $table->unsignedBigInteger('empresa_id')->index();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('tipo_nota_id')->nullable();//catalogo SUNAT
            $table->string('motivo',100)->nullable();
            $table->boolean('is_nota')->default(0);

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
        Schema::dropIfExists('invoices');
    }
}
