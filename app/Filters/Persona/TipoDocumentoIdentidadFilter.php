<?php
namespace App\Filters\Persona;
use App\TipoDocumentoIdentidad;
class TipoDocumentoIdentidadFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_documento_identidad_id', $value)
        ->orWhere('tipo_documento_identidad_id',TipoDocumentoIdentidad::RUC);
    }
}