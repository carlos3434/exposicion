<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class PersonaFilter extends AbstractFilter
{
    protected $filters = [
        'name' => Persona\NameFilter::class,
        'departamento_colegiado_id' => Persona\DepartamentoColegiadoFilter::class //nombre del campo en el request
    ];
}