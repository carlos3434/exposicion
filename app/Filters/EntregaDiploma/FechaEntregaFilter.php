<?php
namespace App\Filters\EntregaDiploma;

class FechaEntregaFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha_entrega) {
                    if (validateDate($fecha_entrega)) {
                        $builder->orWhere('fecha_entrega', date("Y-m-d", strtotime($fecha_entrega)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_entrega', $value);
        }
        return $builder;
    }
}