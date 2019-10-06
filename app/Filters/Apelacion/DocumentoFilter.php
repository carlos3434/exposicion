<?php
namespace App\Filters\Apelacion;

class DocumentoFilter // ProcesoDisciplinario
{
    public function filter($builder, $value)
    {
        return $builder->where('documento_id', $value);
    }
}