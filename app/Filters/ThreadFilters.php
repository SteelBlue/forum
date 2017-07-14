<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    /**
     * @var Request
     */
    protected $request;
    protected $builder;

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

        // Check if filter by username.
        if ($this->request->has('by')) {
            $this->by($this->request->by);
        }

        return $this->builder;
    }

    /**
     * Filters threads by username.
     *
     * @param $username
     * @return mixed
     */
    public function by($username)
    {
        // Get the User from the $username.
        $user = User::where('name', $username)->firstOrFail();

        // Fetch the threads, by a user.
        return $this->builder->where('user_id', $user->id);
    }
}