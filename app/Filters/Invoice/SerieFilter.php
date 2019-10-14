<?php
namespace App\Filters\Invoice;

class SerieFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('serie_id', $value);
    }
}