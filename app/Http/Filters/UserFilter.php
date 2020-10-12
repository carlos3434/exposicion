<?php
namespace App\Http\Filters;

class UserFilter extends QueryFilters
{

    public function estado($value){
        if (is_array($value) && count($value)>0) {
            $builder = $this->builder;
            $builder->where( function($builder) use ($value) {
                foreach ( $value as $estado) {
                    $builder->orWhere('estado', $estado );
                }
            });
            return $builder;
        }else {
            $this->builder->where('estado', $value);
            return $this->builder;
        }
    }
    /**
     * Filter by name.
     *
     * @param  string name
     * @return Builder
     */
    public function name($name = '')
    {
        if ($name=='') {
            return $this->builder;
        }
        return $this->builder->where('name', 'like', '%'.$name.'%');
    }
    /**
     * Filter by difficulty.
     *
     * @param  string email
     * @return Builder
     */
    public function email($email='')
    {
        if ($email=='') {
            return $this->builder;
        }
        return $this->builder->where('email', $email);
    }
    /**
     * Filter by $departamento_id.
     *
     * @param  string $departamento_id
     * @return Builder
     */
    public function departamentoId($departamento_id)
    {
        return $this->builder->where('departamento_id', $departamento_id);
    }
}