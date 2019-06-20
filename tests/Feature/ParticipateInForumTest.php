<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    protected $thread;

    public function setUp() : void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }
    /** @test */
    public function an_authenticated_user_may_participate_in_forum()
    {
        $this->withoutExceptionHandling();
        $user = create(User::class);
        $this->signIn($user);

        $reply = make(Reply::class, ['thread_id' => $this->thread->id, 'user_id'=>$user->id]);

        $this->post($this->thread->path() . '/replies', $reply->toArray());

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function unauthenticated_user_may_not_participate_in_forum()
    {
        $user = create(User::class);

        $reply = make(Reply::class, ['thread_id' => $this->thread->id, 'user_id'=>$user->id]);

        $this->post($this->thread->path() . '/replies', $reply->toArray())
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->signIn();

        $reply = make(Reply::class, ['body'=>null]);

        $this->post($this->thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}