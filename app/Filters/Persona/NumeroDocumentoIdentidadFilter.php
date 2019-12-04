<?php
namespace App\Filters\Persona;

class NumeroDocumentoIdentidadFilter
{
    public function filter($builder, $value)
    {
        return $builder
        ->where('numero_documento_identidad', $value)
        ->orWhere('ruc',$value);
    }
}