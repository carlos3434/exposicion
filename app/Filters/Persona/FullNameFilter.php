<?php
namespace App\Filters\Persona;
use DB;

class FullNameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where(DB::raw('concat(nombres, apellido_paterno , apellido_paterno )'), 'like', '%'.$value.'%');
    }
}