<?php

namespace App\Http\Resources\Ubigeo;

use Illuminate\Http\Resources\Json\JsonResource;

class Ubigeo extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'label' => $this->label,
            'search' => $this->search,
            'number_children' => $this->number_children,
            'level' => $this->level,
            'parent_id' => $this->parent_id
        ];
    }
}
