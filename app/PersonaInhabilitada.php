<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaInhabilitada extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'persona_id',
    ];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('persona_inhabilitada');
    }
}
