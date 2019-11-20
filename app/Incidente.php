<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\IncidenteFilter;
use Illuminate\Database\Eloquent\Builder;

class Incidente extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro', 'descripcion', 'documento', 'url_documento',
    'tipo_incidente_id', 'persona_id','created_by','updated_by','deleted_by'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('incidentes');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new IncidenteFilter($request))->filter($builder);
    }
    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Get the TipoIncidente
     */
    public function tipoIncidente()
    {
        return $this->belongsTo('App\TipoIncidente','tipo_incidente_id');
    }
}
