<?php

namespace App\Http\Resources\ListaPostulante;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListaPostulanteCollection extends ResourceCollection
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
