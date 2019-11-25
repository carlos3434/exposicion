<?php

namespace App\Http\Resources\Pago;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PagoCollection extends ResourceCollection
{
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
                'id'                => $pago->id,

                'name'              => $pago->name,
                'is_primera_cuota'  => $pago->is_primera_cuota,
                'monto'             => $pago->monto,
                'is_fraccion'       => $pago->is_fraccion,
                'fecha_vencimiento' => $pago->fecha_vencimiento,
                'persona_id'        => $pago->persona_id,

                'estado_pago'       => new EstadoPago($pago->estadoPago),
                'concepto'          => new Concepto($pago->concepto),
                'children_pagos'    => new PagoChildrenCollection($pago->childrenPagos),

                'created_at'        => $pago->created_at->toDateTimeString(),
            ]; 
        });
    }
}
