<?php
namespace App\Http\Filters;

class ApelacionFilter extends QueryFilters
{
    /**
     * Filter by $documento_id.
     *
     * @param  string $documento_id
     * @return Builder
     */
    public function documento_id($documento_id)
    {
        return $this->builder->where('documento_id', $documento_id);
    }
    /**
     * Filter by $persona_id.
     *
     * @param  string $persona_id
     * @return Builder
     */
    public function persona_id($persona_id)
    {
        return $this->builder->where('persona_id', $persona_id);
    }
    /**
     * Filter by $fecha_registro.
     *
     * @param  string $fecha_registro
     * @return Builder
     */
    public function fecha_registro($fecha_registro)
    {
        return $this->builder->where('fecha_registro', $fecha_registro);
    }
}