<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request, $builder;

    protected $filters = [];

    /**
     * ThreadFilters constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filters to threads query.
     *
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        // Loop through filters.
        foreach($this->getFilters() as $filter) {
            // Check if the method exists.
            if ($this->hasFilter($filter)) {
                $this->$filter($this->request->$filter);
            }
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

    /**
     * @param $filter
     * @return bool
     */
    public function hasFilter($filter)
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }
}