<?php

namespace App\Http\Resources\User;

use App\Http\Resources\AppCollection;

class UserCollection extends AppCollection
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
                'data' => $this->collection->transform(function ($user) {
                    return new User($user);
                })
            ],
            $this->getPaginate()
        );
    }
}
