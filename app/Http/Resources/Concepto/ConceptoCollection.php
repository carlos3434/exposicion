<?php

namespace App\Http\Resources\Concepto;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ConceptoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
