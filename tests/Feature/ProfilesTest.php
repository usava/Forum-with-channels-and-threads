<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = create(User::class);
    }
    /** @test */
    public function a_user_has_a_profile()
    {
        $this->get('/profiles/' . $this->user->name)
            ->assertSee($this->user->name);
    }

    /** @test */
    public function profiles_display_all_threads_created_by_the_associated_user()
    {
        $this->signIn($this->user);

        $thread = create(Thread::class, ['user_id' => $this->user->id]);

        $this->get('/profiles/' . $this->user->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
