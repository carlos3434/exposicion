<?php

namespace App\Http\Resources\Rendicion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoRendicionCollection extends ResourceCollection
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
            return new TipoRendicion($persona);
        });
    }
}
