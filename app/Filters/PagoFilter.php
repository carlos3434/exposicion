<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class PagoFilter extends AbstractFilter
{
    protected $filters = [
        'persona_id' => Common\PersonaFilter::class,
        'is_fraccion' => Pago\IsFraccionFilter::class,
    ];
}