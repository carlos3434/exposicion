<?php
namespace App\Filters\Ubigeo;

class LevelFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('level', $value);
    }
}