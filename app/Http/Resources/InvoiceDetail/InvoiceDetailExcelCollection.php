<?php

namespace App\Http\Resources\InvoiceDetail;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceDetailExcelCollection extends ResourceCollection
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
            return new InvoiceDetailExcel($persona);
        });
    }
}
