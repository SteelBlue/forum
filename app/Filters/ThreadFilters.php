<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
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