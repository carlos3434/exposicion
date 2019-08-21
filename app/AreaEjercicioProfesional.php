<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaEjercicioProfesional extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('area_ejercicio_profesional');
    }
}
