<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class TransladoFilter extends AbstractFilter
{
    protected $filters = [
        'persona_id' => Common\PersonaFilter::class,
        'fecha_registro' => Common\FechaRegistroFilter::class,
        'origen_departamento_id' => Translado\OrigenDepartamentoFilter::class, //nombre del campo en el request
        'destino_departamento_id' => Translado\DestinoDepartamentoFilter::class //nombre del campo en el request
    ];
}