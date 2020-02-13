<?php

namespace App\Http\Resources\Serie;

use Illuminate\Http\Resources\Json\JsonResource;

class Serie extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'                            => $this->id,
            'name'                          => $this->name . '  -  '.$this->departamento->name,
            //'created_at'                    => $this->created_at->toDateTimeString(),
        ];
    }
}
