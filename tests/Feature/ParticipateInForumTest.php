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
    
    /** @test */
    public function an_authenticated_user_may_participate_in_forum()
    {
        $this->withoutExceptionHandling();
        $user = create(User::class);
        $this->signIn($user);

        $thread = create(Thread::class);
        $reply = make(Reply::class, ['thread_id' => $thread->id, 'user_id'=>$user->id]);

        $this->post($thread->path() . '/replies', $reply->toArray());


        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function unauthenticated_user_may_not_participate_in_forum()
    {
        $user = create(User::class);

        $thread = create(Thread::class);
        $reply = make(Reply::class, ['thread_id' => $thread->id, 'user_id'=>$user->id]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertRedirect('/login');
    }
}
