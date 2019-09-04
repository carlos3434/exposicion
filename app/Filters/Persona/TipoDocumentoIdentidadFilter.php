<?php
namespace App\Filters\Persona;

class TipoDocumentoIdentidadFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_documento_identidad_id', $value);
    }
}