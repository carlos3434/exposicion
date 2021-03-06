<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\TipoOperacionFilter;
use Illuminate\Database\Eloquent\Builder;
class TipoOperacion extends Model
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

        $this->setTable('tipo_operacion');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new TipoOperacionFilter($request))->filter($builder);
    }
}
