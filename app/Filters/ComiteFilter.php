<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class ComiteFilter extends AbstractFilter
{
    protected $filters = [
        'persona'            => Comite\PersonaFilter::class,
        'cargo_postulante'   => Comite\CargoPostulanteFilter::class,
        'fecha_registro'     => Comite\FechaRegistroFilter::class,
    ];
}