<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\EmpresaFilter;
use Illuminate\Database\Eloquent\Builder;

class Empresa extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
            'ruc',
            'nombre_comercial',
            'certificado_digital',
            'razon_social',
            'direccion_web',
            'telefono',
            'email',
            'direccion',
            'logo',
            'ubigeo_id',
            'user_sunat',
            'password_sunat',
            'entorno',
            'updated_by', 'created_by', 'deleted_by'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('empresas');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new EmpresaFilter($request))->filter($builder);
    }
    /**
     * Get the Ubigeo
     */
    public function ubigeo()
    {
        return $this->belongsTo('App\Ubigeo');
    }
}
