<?php

namespace App\Http\Resources\CajaChica;

use Illuminate\Http\Resources\Json\JsonResource;

class CajaChicaExcel extends JsonResource
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
            'id'                => $this->id,

            'numero_documento_pago'                 => $this->numero_documento_pago,
            'beneficiario'                  => $this->beneficiario,
            'proveedor'                 => $this->proveedor,
            'descripcion'                   => $this->descripcion,
            'monto'                 => $this->monto,
            'fecha'                 => $this->fecha,
            'glosa'                 => $this->glosa,
            'departamento'      => new Departamento($this->departamento),
            'concepto'          => new Concepto($this->concepto),
            'tipo_documento_pago'  => new TipoDocumentoPago($this->tipoDocumentoPago),

            'created_at'        => $this->created_at->toDateTimeString(),
        ];
    }
}
