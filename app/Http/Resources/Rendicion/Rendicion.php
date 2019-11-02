<?php

namespace App\Http\Resources\Rendicion;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Responsable\ResponsableCollection;
class Rendicion extends JsonResource
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

            'tipo_documento_pago'                   => new TipoDocumentoPagoCollection($this->tipoDocumentoPago),
            'tipo_documento_identidad'              => new TipoDocumentoIdentidadCollection($this->tipoDocumentoIdentidad),
            'tipo_rendicion'                        => new TipoRendicionCollection($this->tipoRendicion),
            'responsable'                           => new ResponsableCollection($this->responsable),

            'created_at'                            => $this->created_at->toDateTimeString(),

        ];
    }
}
