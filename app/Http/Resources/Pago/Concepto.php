<?php

namespace App\Http\Resources\Pago;

use Illuminate\Http\Resources\Json\JsonResource;

class Concepto extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                            => $this->id,
            'name'                => $this->name,
            'fraccionable'                => boolval($this->fraccionable),
            //'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
