<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->signIn();
        $this->thread = create(Thread::class)->subscribe();
    }

    /** @test */
    public function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply()
    {
        $this->assertCount(0, auth()->user()->notifications);

        $this->thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some body here'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $this->thread->addReply([
            'user_id' => create(User::class)->id,
            'body' => 'Some body here'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->thread->addReply([
            'user_id' => create(User::class)->id,
            'body' => 'Some body here'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->unreadNotifications);

        $notification = $this->user->unreadNotifications->first();

        $this->delete("/profiles/{$this->user->name}/notifications/{$notification->id}");

        $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);
    }

    /** @test */
    public function a_user_can_fetch_their_unread_notifications()
    {
        create(DatabaseNotification::class);

        $response = $this->getJson("/profiles/{$this->user->name}/notifications")->json();
        $this->assertCount(1, $response);
    }
}
