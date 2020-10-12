<?php
namespace App\Http\Filters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilters
{
    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;
    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (! method_exists($this, $name)) {
                continue;
            }
            if (is_array($value) || strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }
        return $this->builder;
    }
    /**
     * Get all request filters data.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }
    public function toExport()
    {
        if (isset($this->request->excel) || isset($this->request->pdf)) {
            return true;
        }
        return false;
    }
    //&sort[value]=id&sort[direction]=asc
    public function sort($sort)
    {
        if (!isset($sort['value'])) {
            $sort['value'] = 'id';
        }
        if (!isset($sort['direction'])) {
            $sort['direction'] = 'desc';
        }
        return $this->builder->orderBy($sort['value'],$sort['direction']);
    }
}