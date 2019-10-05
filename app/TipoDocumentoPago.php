<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoPago extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name','codigo_sunat'];
    const FACTURA = 1;
    const BOLETA = 2;
    const NOTA_CREDITO = 3;
    const NOTA_DEBITO = 4;
    const GUIA_REMOSION = 5;
    const TICKET = 6;
    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('tipo_documento_pago');
    }
}
