<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\BeneficiarioFilter;
use Illuminate\Database\Eloquent\Builder;

class Beneficiario extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'tipo_documento_identidad_id',
        'numero_documento_identidad',
        'direccion',
        'telefono',
        'email',
        'persona_id',
        'updated_by',
        'created_by',
        'deleted_by'
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

        $this->setTable('beneficiarios');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new BeneficiarioFilter($request))->filter($builder);
    }
    /**
     * Get the TipoDocumentoIdentidad
     */
    public function tipoDocumentoIdentidad()
    {
        return $this->hasMany('App\TipoDocumentoIdentidad');
    }

    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

}
