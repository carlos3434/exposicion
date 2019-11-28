<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoPago extends Model
{
    const PENDIENTE = 1;
    const COMPLETADA = 2;
    const FRACCIONADA = 3;
    //cuando un pago es fraccionado, solo se debe considerar el monto de los pagos hijos
    const EXONERADO = 4;
    const ELIMINADO = 5;
    const ADELANTO = 6;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name'
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

        $this->setTable('estado_pagos');
    }
}
