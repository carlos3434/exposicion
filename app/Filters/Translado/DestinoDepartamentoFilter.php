<?php
namespace App\Filters\Translado;

class DestinoDepartamentoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('destino_departamento_id', $value);
    }
}