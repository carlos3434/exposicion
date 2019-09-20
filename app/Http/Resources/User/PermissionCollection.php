<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PermissionCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    //public $collects = 'App\Http\Resources\Permission';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($permission) {
            return [
                'id' => $permission->id,
                'name' => $permission->name,
                'slug' => $permission->slug,
            ];
            //return $role->id;
        });
    }

}
