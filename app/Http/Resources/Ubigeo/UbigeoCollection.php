<?php

namespace App\Http\Resources\Ubigeo;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

class UbigeoCollection extends ResourceCollection
{
    private $paginate=[];
    public function __construct($filter)
    {
        $this->setPaginate( $filter );
        parent::__construct($filter);
    }

    private function getPaginate(){
        return $this->paginate;
    }
    private function setPaginate($filter)
    {
        if ( method_exists($filter,'toArray') && $filter instanceof AbstractPaginator) {
            $paginate = $filter->toArray();
            unset( $paginate["data"] );
            $this->paginate = $paginate;
        }
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
