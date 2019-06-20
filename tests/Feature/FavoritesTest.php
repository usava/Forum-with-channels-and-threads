<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_replies()
    {
        $this->signIn();

        $reply = create(Reply::class);
        $this->post('replies/' . $reply->id . '/favorites', []);
            $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function guests_cannot_favorite_anything()
    {
        $this->post('replies/1/favorites')->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = create(Reply::class);
        $this->post('replies/' . $reply->id . '/favorites');
        $this->post('replies/' . $reply->id . '/favorites');
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_unfavorite_a_reply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $reply->favorite();

        $this->delete('replies/' . $reply->id . '/favorites');
        $this->assertCount(0, $reply->fresh()->favorites);
    }

}
