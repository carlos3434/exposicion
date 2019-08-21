<?php
namespace App\Filters\User;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('name', 'like', '%'.$value.'%');
        //return $builder->where('name', $value);
    }
}