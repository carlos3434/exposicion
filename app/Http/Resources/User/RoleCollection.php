<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    //public $collects = 'App\Http\Resources\Role';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'special' => $role->special,
            ];
            //return $role->id;
        });
    }
}
