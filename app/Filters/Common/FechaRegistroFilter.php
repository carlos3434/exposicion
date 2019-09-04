<?php
namespace App\Filters\Common;

class FechaRegistroFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha_registro) {
                    if (validateDate($fecha_registro)) {
                        $builder->orWhere('fecha_registro', date("Y-m-d", strtotime($fecha_registro)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_registro', $value);
        }
        return $builder;
    }
}