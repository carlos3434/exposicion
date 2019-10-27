<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class GastoDetailFilter extends AbstractFilter
{
    protected $filters = [
        'tipo_gasto_id'   => GastoDetail\TipoGastoFilter::class,
        'tipo_documento_pago_id'    => GastoDetail\TipoDocumentoPagoFilter::class,
    ];
}