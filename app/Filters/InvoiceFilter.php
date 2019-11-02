<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class InvoiceFilter extends AbstractFilter
{
    protected $filters = [
        //'departamento_id'   => Common\DepartamentoFilter::class,
        'tipo_documento_pago_id'   => Invoice\TipoDocumentoPagoFilter::class,
        'numero'            => Invoice\NumeroFilter::class,
        'serie_id'            => Invoice\SerieFilter::class,
        'fecha_emision'    => Invoice\FechaEmisionFilter::class,
    ];
}