<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

   /** @test */
   public function a_user_can_view_all_threads()
   {
       $thread = factory(Thread::class)->create();

       $response = $this->get('/threads');
       $response->assertStatus(200);
   }

   /** @test */
   public function a_user_can_see_single_thread()
   {
       $thread = factory(Thread::class)->create();

       $response = $this->get('/threads/' . $thread->id);
       $response->assertSee($thread->title);
   }
}
