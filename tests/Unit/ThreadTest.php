<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ThreadTest extends TestCase
{
   use DatabaseMigrations;

    protected $thread;

    public function setUp() : void {
       parent::setUp();

       $this->thread = create(Thread::class);
   }
   /** @test */
   public function a_thread_has_replies()
   {
       $this->assertInstanceOf(Collection::class, $this->thread->replies);
   }

   /** @test */
   public function a_thread_has_a_creator()
   {
       $this->assertInstanceOf(User::class, $this->thread->creator);
   }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' =>'Foobar',
            'user_id' => 1
        ]);
        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function a_thread_belongs_to_a_channel()
    {
        $this->assertInstanceOf(\App\Channel::class, $this->thread->channel);
    }

    /** @test */
    public function a_thread_can_make_a_string_path()
    {
        $this->assertEquals( "/threads/{$this->thread->channel->slug}/{$this->thread->id}", $this->thread->path());
    }

    /** @test */
    public function a_thread_can_be_subscribed_to()
    {
        $this->signIn();

        $this->thread->subscribe();
        $this->assertEquals(1, $this->thread->subscriptions()->where('user_id', auth()->id())->count());
    }

    /** @test */
    public function a_thread_can_be_unsubscribed_from()
    {
        $this->signIn();

        $this->thread->unsubscribe();
        $this->assertEquals(0, $this->thread->subscriptions()->where('user_id', auth()->id())->count());
    }
    
    /** @test */
    public function it_knows_if_an_authenticated_user_subscribed_to_it()
    {
        $this->signIn();

        $this->assertFalse($this->thread->isSubscribedTo);
        $this->thread->subscribe();
        $this->assertTrue($this->thread->isSubscribedTo);
    }
}
