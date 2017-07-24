<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['by', 'popular'];

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return mixed
     */
    protected function by($username)
    {
        // Get the User from the $username.
        $user = User::where('name', $username)->firstOrFail();

        // Fetch the threads, by a user.
        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter the query according to most popular threads.
     *
     * @return $this
     */
    protected function popular()
    {
        // Remove any existing order_by from the query.
        $this->builder->getQuery()->orders = [];

        // Fetch the threads, by popularity.
        $this->builder->orderBy('replies_count', 'desc');
    }
}