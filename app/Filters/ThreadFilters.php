<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilters
{
    /**
     * @var Request
     */
    private $request;


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
        // Check if query by username.
        if (! $username = $this->request->by) return $builder;

        // Apply filter for user created threads.
        return $this->by($builder, $username);

    }

    /**
     * Filters threads by username.
     *
     * @param $builder
     * @param $username
     * @return mixed
     */
    public function by($builder, $username)
    {
        // Get the User from the $username.
        $user = User::where('name', $username)->firstOrFail();

        // Fetch the threads, by a user.
        return $builder->where('user_id', $user->id);
    }
}