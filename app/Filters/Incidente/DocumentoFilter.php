<?php
namespace App\Filters\Incidente;

class DocumentoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('documento', 'like', '%'.$value.'%');
    }
}