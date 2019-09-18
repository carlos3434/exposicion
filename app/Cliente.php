<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\ClienteFilter;
use Illuminate\Database\Eloquent\Builder;

class Cliente extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'razon_social',
        'direccion',
        'tipo_documento_identidad_id',
        'numero_documento_identidad',
        'telefono',
        'celular',
        'email',
        'updated_by', 'created_by', 'deleted_by'
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

        $this->setTable('clientes');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ClienteFilter($request))->filter($builder);
    }
    /**
     * Get the TipoDocumentoIdentidad
     */
    public function tipoDocumentoIdentidad()
    {
        return $this->belongsTo('App\TipoDocumentoIdentidad');
    }
}
