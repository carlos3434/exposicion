<?php

namespace App\Http\Resources\Inventario;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoInventario extends JsonResource
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

}
