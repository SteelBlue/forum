<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * Favorite a reply.
     */
    public function favorite()
    {
        // Check if user has not favorited the reply.
        if (!$this->favorites()->where(['user_id' => auth()->id()])->exists()) {
            $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }
}
