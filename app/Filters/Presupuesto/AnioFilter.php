<?php
namespace App\Filters\Presupuesto;
use DB;
class AnioFilter
{
    public function filter($builder, $value)
    {
        return $builder->where(DB::raw('YEAR( mes )'), $value);
    }
}