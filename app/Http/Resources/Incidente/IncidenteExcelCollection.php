<?php

namespace App\Http\Resources\Incidente;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IncidenteExcelCollection extends ResourceCollection
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
            return new IncidenteExcel($persona);
        });
    }
}
