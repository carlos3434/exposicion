<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class ListaPostulanteFilter extends AbstractFilter
{
    protected $filters = [
        'cargo_postulante_id'     => Common\CargoPostulanteFilter::class,
        'departamento_id'         => Common\DepartamentoFilter::class,
        'fecha_registro'          => Common\FechaRegistroFilter::class,
        'persona_id'              => Common\PersonaFilter::class,
    ];
}