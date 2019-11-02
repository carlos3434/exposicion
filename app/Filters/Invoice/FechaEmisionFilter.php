<?php
namespace App\Filters\Invoice;

class FechaEmisionFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha_emision) {
                    if (validateDate($fecha_emision)) {
                        $builder->orWhere('fecha_emision', date("Y-m-d", strtotime($fecha_emision)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_emision', $value);
        }
        return $builder;
    }
}