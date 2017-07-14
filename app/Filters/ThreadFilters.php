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

    public function apply($builder)
    {
        // Apply filter for user created threads.
        if ($username = $this->request->by) {
            // Get the User from the $username.
            $user = User::where('name', $username)->firstOrFail();

            // Fetch the threads, by a user.
            return $builder->where('user_id', $user->id);
        }
    }
}