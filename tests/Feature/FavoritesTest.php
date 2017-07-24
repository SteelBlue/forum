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
}