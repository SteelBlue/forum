<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_can_create_a_new_forum_thread()
    {
        // Given we have a signed in user.
        $this->actingAs(factory('App\User')->create());

        // When we hit the endpoint to create a new thread.
        $thread = factory('App\Thread')->make();
        $this->post('/threads', $thread->toArray());


        // Then, we visit the new thread page.
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
