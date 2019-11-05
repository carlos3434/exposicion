<?php

namespace App\Http\Resources\Inventario;

use Illuminate\Http\Resources\Json\JsonResource;

class InventarioExcel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                                    => $this->id,
            'periodo'                               => $this->periodo,
            'fecha'                                 => $this->fecha,
            'serie'                                 => $this->serie,
            'numero'                                => $this->numero,
            'numero_documento_identidad'            => $this->numero_documento_identidad,
            'razon_social'                          => $this->razon_social,
            'base'                                  => $this->base,
            'igv'                                   => $this->igv,
            'monto_no_gravado'                      => $this->monto_no_gravado,
            'importe_total'                         => $this->importe_total,
            'descripcion'                           => $this->descripcion,

            'tipo_documento_pago'                   => isset($this->tipoDocumentoIdentidad->name) ? $this->tipoDocumentoIdentidad->name : '' ,
            'tipo_documento_identidad'              => isset($this->tipoInventario->name) ? $this->tipoInventario->name : '' ,
            'tipo_Inventario'                        => isset($this->tipoDocumentoPago->name) ? $this->tipoDocumentoPago->name : '' ,

            'created_at'                    => $this->created_at->toDateTimeString(),

        ];
    }
}
