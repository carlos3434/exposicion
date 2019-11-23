<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Invoice\EmpresaCollection;
use App\Http\Resources\Invoice\TipoOperacionCollection;
use App\Http\Resources\Invoice\ClienteCollection;
use App\Http\Resources\Invoice\TipoDocumentoPagoCollection;
use App\Http\Resources\Invoice\SerieCollection;

class Invoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent=>=>toArray($request);
        return [

            'id'                        => $this->id,
            'numero'                    => $this->numero,
            'fecha_emision'             => $this->fecha_emision,
            'fecha_vencimiento'         => $this->fecha_vencimiento,
            'tipo_moneda'               => $this->tipo_moneda,

            'descuento_total'           => $this->descuento_total,
            'monto_inafecta'            => $this->monto_inafecta,
            'monto_gravada'             => $this->monto_gravada,
            'igv_total'                 => $this->igv_total,
            'monto_total'               => $this->monto_importe_total_venta,
            'valor_venta'               => $this->valor_venta,
            'monto_importe_total_venta' => $this->monto_importe_total_venta,
            'monto_exogerado'           => $this->monto_exogerado,
            'monto_gratuito'            => $this->monto_gratuito,
            'xml_path'                  => $this->xml_path,
            'pdf_path'                  => $this->pdf_path,
            'cdr_path'                  => $this->cdr_path,
            'invoice_id'                => $this->invoice_id,
            'tipo_nota_id'              => $this->tipo_nota_id,
            'motivo'                    => $this->motivo,

            'empresa'                   => new EmpresaCollection($this->empresa),
            'tipo_operacion'            => new TipoOperacionCollection($this->tipoOperacion),
            'cliente'                   => new ClienteCollection($this->cliente),
            'tipo_documento_pago'       => new TipoDocumentoPagoCollection($this->tipoDocumentoPago),
            'serie'                     => new SerieCollection($this->serie),
            'invoice_detail'            => new InvoiceDetailCollection($this->invoiceDetail),
            'created_at'                => $this->created_at->toDateTimeString(),

        ];
    }
}
