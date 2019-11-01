<?php

namespace App\Http\Resources\Gasto;

use Illuminate\Http\Resources\Json\JsonResource;

class GastoDetail extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id'                            => $this->id,
            'fecha'                         => $this->fecha,
            'fecha_fin'                     => $this->fecha_fin,
            'detalle'                       => $this->detalle,
            'ruc'                           => $this->ruc,
            'razon_social'                  => $this->razon_social,
            'serie'                         => $this->serie,
            'numero'                        => $this->numero,
            'monto'                         => $this->monto,
            'salida'                        => $this->salida,
            'llegada'                       => $this->llegada,
            'lugar'                         => $this->lugar,
            'ruta'                          => $this->ruta,

            'tipo_gasto_id'                 => $this->tipo_gasto_id,
            'tipo_documento_pago_id'        => $this->tipo_documento_pago_id,

            'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
