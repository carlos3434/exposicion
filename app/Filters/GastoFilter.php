<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class GastoFilter extends AbstractFilter
{
    protected $filters = [
        'fecha_registro' => Common\FechaRegistroFilter::class,
        //'persona_id' => Common\PersonaFilter::class,
        'cargo_id' => Gasto\CargoPostulanteFilter::class,
        'departamento_id' => Common\DepartamentoFilter::class,
    ];
}