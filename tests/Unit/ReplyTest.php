<?php

namespace Tests\Unit;

use App\Reply;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function reply_has_an_owner()
    {
        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
