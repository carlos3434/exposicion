<?php
namespace App\Filters\Ubigeo;

class ParentFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('parent_id', $value);
    }
}