<?php
namespace App\Filters\Invoice;

class NumeroFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('numero', $value);
    }
}