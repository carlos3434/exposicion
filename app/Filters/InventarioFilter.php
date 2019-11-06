<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class InventarioFilter extends AbstractFilter
{
    protected $filters = [
        'departamento_id'        => Common\DepartamentoFilter::class,
        'tipo_inventario_id'      => Inventario\TipoInventarioFilter::class,//ProcesoDisciplinario
        'estado_inventario_id'    => Inventario\EstadoInventarioFilter::class,
    ];
}