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
    public function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        // Guest cannot visit threads/create.
        $this->get('threads/create')
            ->assertRedirect('/login');

        // Guest cannot post to /threads.
        $this->post('threads')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_new_forum_thread()
    {
        // Given we have a signed in user.
        $this->signIn();

        // When we hit the endpoint to create a new thread.
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());


        // Then, we visit the new thread page.
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
