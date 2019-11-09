<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\ResourceCollection;


class InvoiceDetailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($persona) {
            return new InvoiceDetail($persona);
        });
        return parent::toArray($request);
        return [
            'id'                    => $this->id,
            'descripcion'           => $this->descripcion,
            'precio'                => $this->precio,
            'cantidad'              => $this->cantidad,
            'descuento_linea'       => $this->descuento_linea,
            'porcentaje_igv'        => $this->porcentaje_igv,
            'igv'                   => $this->igv,
            'impuestos'             => $this->impuestos,
            'valor_unitario'        => $this->valor_unitario,
            'precio_unitario'       => $this->precio_unitario,
            'valor_venta'           => $this->valor_venta,
            'base_igv'              => $this->base_igv,
            'concepto_id'           => $this->concepto_id,
            'created_at'            => $this->created_at->toDateTimeString(),
        ];
    }
}
