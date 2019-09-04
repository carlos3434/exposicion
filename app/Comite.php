<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\ComiteFilter;
use Illuminate\Database\Eloquent\Builder;


class Comite extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['fecha_registro', 'observacion', 
    'cargo_postulante_id', 'updated_by', 'created_by', 'deleted_by','persona_id'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('comites');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ComiteFilter($request))->filter($builder);
    }
    /**
     * Get the Persona
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Get the CargoPostulante
     */
    public function cargoPostulante()
    {
        return $this->belongsTo('App\CargoPostulante', 'cargo_postulante_id');
    }
}
