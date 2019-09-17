<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceExcelCollection extends ResourceCollection
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
            return new InvoiceExcel($persona);
        });
    }
}
