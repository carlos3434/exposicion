<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class InventarioFilter extends AbstractFilter
{
    protected $filters = [
        'departamento_id'        => Common\PersonaFilter::class,
        'tipo_inventario_id'      => Apelacion\DocumentoFilter::class,//ProcesoDisciplinario
        'estado_inventario_id'    => Common\FechaRegistroFilter::class,
    ];
}