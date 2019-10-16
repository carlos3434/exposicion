<?php
namespace App\Filters\Beneficiario;

class NumeroDocumentoIdentidadFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('numero_documento_identidad', $value);
    }
}