<?php
namespace App\Filters\Gasto;

class TipoDocumentoPagoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_documento_pago_id', $value);
    }
}