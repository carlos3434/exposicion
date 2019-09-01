<?php

namespace App\Http\Resources\Persona;

use App\Http\Resources\AppCollection;

class PersonaCollection extends AppCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            [
                'data' => $this->collection->transform(function ($persona) {
                    return new Persona($persona);
                })
            ],
            $this->getPaginate()
        );
    }
}
