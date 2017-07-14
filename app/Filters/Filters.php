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
        foreach($this->filters as $filter) {
            // Check if the method exists.
            if (method_exists($this, $filter) && $this->request->has($filter)) {
                $this->$filter($this->request->$filter);
            }
        }

        return $this->builder;
    }
}