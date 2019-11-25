<?php

namespace App\Http\Resources\Persona;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PagoCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($pago) {
            return [
                'id'                    => $pago->concepto->id,
                'name'                  => $pago->concepto->name,
                'cantidad'              => 1,
                'is_primera_cuota'      => $pago->concepto->is_primera_cuota,
                'name'                  => $pago->concepto->name,
                'unidad_medida'         => $pago->concepto->unidad_medida,
                'codigo'                => $pago->concepto->codigo,
                'codigo_sunat'          => $pago->concepto->codigo_sunat,
                //'precio'                => $pago->concepto->precio,
                'tipo_afecta_igv'       => $pago->concepto->tipo_afecta_igv,
                'tipo'                  => $pago->concepto->tipo,
                'monto'                 => $pago->monto,
                'fecha_vencimiento'     => $pago->fecha_vencimiento,
                'estado_pago_id'        => $pago->estado_pago_id,
                'pago_id'               => $pago->id
            ];
        });
    }

}
