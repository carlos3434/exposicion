<?php
namespace App\Filters\Persona;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('nombres', 'like', '%'.$value.'%');
    }
}