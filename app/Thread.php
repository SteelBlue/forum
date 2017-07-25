<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     *
     *
     * @var array
     */
    protected $with = ['owner', 'channel'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Set the Global Scope, count of replies for a thread.
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
    }

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    /**
     * Add a reply to the thread.
     *
     * @param $reply
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    /**
     * A thread belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A thread may have many replies.
     * Return with a count for the favorites relationship.
     * Return with the owner of the reply.
     *
     * @return mixed
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * A thread is assigned a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
