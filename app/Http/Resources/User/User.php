<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\RoleCollection as RolesByUserCollection;
use App\Http\Resources\User\PermissionCollection as PermissionsByUserCollection;

class User extends JsonResource
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
            'email' => $this->email,
            'departamento_id' => $this->departamento_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'roles' => new RolesByUserCollection($this->roles),
            'permissions' => new PermissionsByUserCollection($this->permissions)
        ];
    }
}
