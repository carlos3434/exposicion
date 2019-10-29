<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class RendicionFilter extends AbstractFilter
{
    protected $filters = [
        'periodo'           => Rendicion\PeriodoFilter::class,
        'tipo_rendicion_id' => Rendicion\TipoRendicionFilter::class,
        'fecha'             => Rendicion\FechaFilter::class,
    ];
}