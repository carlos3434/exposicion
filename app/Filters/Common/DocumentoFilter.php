<?php
namespace App\Filters\Common;

class DocumentoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('documento', 'like', '%'.$value.'%');
    }
}