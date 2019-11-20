<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->decimal('precio')->default(0);
            $table->integer('cantidad')->default(0);
            $table->decimal('descuento_linea')->default(0);

            $table->decimal('porcentaje_igv')->default(0);
            $table->decimal('igv')->default(0);
            $table->decimal('impuestos')->default(0);
            $table->decimal('valor_unitario')->default(0);
            $table->decimal('precio_unitario')->default(0);
            $table->decimal('valor_venta')->default(0);
            $table->decimal('base_igv')->default(0);

            $table->unsignedBigInteger('pago_id')->index();
            $table->unsignedBigInteger('invoice_id')->index();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            $table->unsignedBigInteger('concepto_id')->index();
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onDelete('cascade');
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
        Schema::dropIfExists('invoice_detail');
    }
}
