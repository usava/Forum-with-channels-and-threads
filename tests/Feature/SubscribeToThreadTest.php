<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_subscribe_to_thread()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(1, $thread->subscriptions);
    }

    /** @test */
    public function a_user_can_unsubscribe_to_thread()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $thread->subscribe();
        $this->assertCount(1, $thread->subscriptions);

        $this->delete($thread->path() . '/subscriptions');
        $this->assertCount(0, $thread->fresh()->subscriptions);
    }
}
