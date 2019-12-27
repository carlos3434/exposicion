<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\ApelacionFilter;
use Illuminate\Database\Eloquent\Builder;


class Apelacion extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro','resolucion', 'persona_id', 'updated_by', 
    'created_by', 'deleted_by','is_titular','representanteNombres', 'url_documento',
    'is_apelacion', 'url_documento_nacional', 'resolucion_nacional',
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
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ApelacionFilter($request))->filter($builder);
    }
    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Get the ProcesoDisciplinario
     */
    public function documento()
    {
        return $this->belongsTo('App\ProcesoDisciplinario', 'documento_id');
    }
}
