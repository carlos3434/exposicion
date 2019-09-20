<?php

namespace App\Http\Resources\Ubigeo;

use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Pagination\AbstractPaginator;

class UbigeoCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($ubigeo) {
            return new Ubigeo($ubigeo);
        });
    }
}
