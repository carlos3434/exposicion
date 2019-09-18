<?php

namespace App\Http\Resources\InvoiceDetail;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
