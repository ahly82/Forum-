<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function channel_consists_of_some_threads()
    {
        $channel = create('App\Channel');
        $thread = create('App\Thread',['channel_id'=>$channel->id]);

        //$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $channel->threads); Is Correct Also
        $this->assertTrue($channel->threads->contains($thread));
    }
}
