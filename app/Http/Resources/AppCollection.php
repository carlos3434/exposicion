<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

class AppCollection extends ResourceCollection
{
    protected $paginate=[];
    public function __construct($filter)
    {
        $this->setPaginate( $filter );

        parent::__construct($filter);
    }
    protected function getPaginate(){
        return $this->paginate;
    }
    protected function setPaginate($filter)
    {
        if ( method_exists($filter,'toArray') && $filter instanceof AbstractPaginator) {
            $paginate = $filter->toArray();
            unset( $paginate["data"] );
            $this->paginate = $paginate;
        }
    }
}
