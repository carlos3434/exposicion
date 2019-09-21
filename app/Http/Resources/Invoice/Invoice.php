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

            //'empresa_id'                => new EmpresaCollection($this->empresa_id),
            /*'tipo_operacion'         => new TipoOperacionCollection($this->tipoOperacion),
            'cliente'                => new ClienteCollection($this->cliente),
            'tipo_documento_pago'    => new TipoDocumentoPagoCollection($this->tipoDocumentoPago),
            'serie'                  => new SerieCollection($this->serie),*/
            'created_at'                => $this->created_at->toDateTimeString(),

        ];
    }
}
