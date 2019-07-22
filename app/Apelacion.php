<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apelacion extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro','resolucion', 'persona_id', 'updated_by', 
    'created_by', 'deleted_by','is_titular','representanteNombres',
    'representanteApellidoPaterno','representanteApellidoMaterno','documento_id'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('apelacions');
    }
}
