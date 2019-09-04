<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class ComiteFilter extends AbstractFilter
{
    protected $filters = [
        'persona_id'            => Comite\PersonaFilter::class,
        'cargo_postulante_id'   => Comite\CargoPostulanteFilter::class,
        'fecha_registro'     => Comite\FechaRegistroFilter::class,
    ];
}