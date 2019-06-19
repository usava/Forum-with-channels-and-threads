<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
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

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        create('App\Channel', ['id' => 2]);

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function a_thread_can_be_deleted()
    {
        $this->signIn();
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $this->json('DELETE', $thread->path())
            ->assertStatus(204);

        $this->assertDatabaseMissing('threads', $thread->only('id'));
        $this->assertDatabaseMissing('replies', $reply->only('id'));
    }

    /** @test */
    public function guests_can_not_delete_threads()
    {
        $thread = create(Thread::class);

        $this->delete($thread->path())
            ->assertRedirect('/login');

    }

//    /** @test */
    public function threads_can_only_be_deleted_by_the_owner()
    {

    }
}
