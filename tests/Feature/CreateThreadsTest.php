<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = make(Thread::class);
    }

    /** @test */
    public function an_authenticated_user_can_create_threads()
    {
        $this->signIn();

        $this->followingRedirects()->post('/threads', $this->thread->toArray())
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);


    }

    /** @test */
    public function guests_cannot_create_threads()
    {

        $this->post('/threads', $this->thread->toArray())
            ->assertRedirect('/login');

        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

}
