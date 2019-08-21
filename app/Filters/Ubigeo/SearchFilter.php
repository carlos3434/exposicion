<?php
namespace App\Filters\Ubigeo;

class SearchFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('search', $value);
    }
}