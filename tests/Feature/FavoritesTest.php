<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_not_favorite_anything()
    {
        // Use ExceptionHandling
        $this->withExceptionHandling();

        // If guest tries to post to a "favorite" endpoint.
        $this->post('/replies/1/favorites')
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        // Sign in a user.
        $this->signIn();

        // Create a reply, which will also create a thread.
        $reply = create('App\Reply');

        // If I post to a "favorite" endpoint.
        $this->post('/replies/' . $reply->id . '/favorites');

        // It should be recorded in the database.
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        // Sign in a user.
        $this->signIn();

        // Create a reply, which will also create a thread.
        $reply = create('App\Reply');

        try {
            // First post to a "favorite" endpoint.
            $this->post('/replies/' . $reply->id . '/favorites');
            // Second post to a "favorite" endpoint.
            $this->post('/replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        // It should be recorded in the database.
        $this->assertCount(1, $reply->favorites);
    }
}