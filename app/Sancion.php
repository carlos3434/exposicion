<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    const EXPULSION = 1;
    const SUSPENCION = 2;
    const MULTA = 3;
    const AMONESTACION = 4;
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

        $this->setTable('sancions');
    }
}
