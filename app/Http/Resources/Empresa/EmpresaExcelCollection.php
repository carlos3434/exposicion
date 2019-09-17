<?php

namespace App\Http\Resources\Empresa;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmpresaExcelCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($persona) {
            return new EmpresaExcel($persona);
        });
    }
}
