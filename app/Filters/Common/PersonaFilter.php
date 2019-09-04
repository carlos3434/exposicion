<?php
namespace App\Filters\Common;

class PersonaFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('persona_id', $value);
    }
}