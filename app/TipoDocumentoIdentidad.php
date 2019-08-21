<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoIdentidad extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name','codigo_sunat'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('tipo_documento_identidad');
    }
}
