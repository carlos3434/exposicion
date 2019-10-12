<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoRegistroColegiado extends Model
{
    const NUEVO = 1;
    const INSCRITO = 2;
    const SOLICITUD_PENDIENTE = 3;
    const SOLICITUD_RESUELTA = 4;
    const SOLICITUD_VALIDADA = 5;
    const CARNET_GENERADO = 6;
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

        $this->setTable('estado_registro_colegiado');
    }
}
