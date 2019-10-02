<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User\PermissionCollection;
class Role extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'special' => $this->special,
            'created_at' => $this->created_at->toDateTimeString(),
            'permissions' => new PermissionCollection($this->permissions)
        ];
    }
}
