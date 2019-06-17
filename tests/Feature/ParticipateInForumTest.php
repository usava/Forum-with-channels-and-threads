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
    use DatabaseMigrations;
    
    /** @test */
    public function an_authenticated_user_may_participate_in_forum()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->signIn($user);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make(['thread_id' => $thread->id, 'user_id'=>$user->id]);

        $this->post($thread->path() . '/replies', $reply->toArray());


        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function unauthenticated_user_may_not_participate_in_forum()
    {
        $user = factory(User::class)->create();

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make(['thread_id' => $thread->id, 'user_id'=>$user->id]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertRedirect('/login');
    }
}
