<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\TipoInvoiceFilter;
use Illuminate\Database\Eloquent\Builder;

class TipoInvoice extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('tipo_invoice');
    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new TipoInvoiceFilter($request))->filter($builder);
    }
    /**
     * Get the 
     */
    public function persona()
    {
        return $this->belongsTo('App\A');
    }
}
