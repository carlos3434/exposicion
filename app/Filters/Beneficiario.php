<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class BeneficiarioFilter extends AbstractFilter
{
    protected $filters = [
        'numero_documento_identidad'   => Beneficiario\NumeroDocumentoIdentidadFilter::class,
        'persona_id'   => Common\PersonaFilter::class,
    ];
}