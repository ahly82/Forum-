<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    private $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_browse_a_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_browse_a_thread()
    {

        $this->get( $this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_user_created_a_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->creator->name);
    }

    /** @test */
    public function a_user_can_read_replies_associated_with_a_thread()
    {
        $reply = create('App\Reply',['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);

    }


    /** @test */
    public function a_user_can_filter_threads_according_to_a_tag() // By Channel
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread',['channel_id' =>$channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title );

    }


    /** @test */
                public function a_user_can_filter_threads_by_username()
    {

        $this->signIn(create('App\User',['name' => 'Osama Yasser']));
        $threadByOsama = create('App\Thread',['user_id' =>Auth()->id()]);
        $threadNotByOsama = create('App\Thread');

        $this->get('threads?by=Osama Yasser')
            ->assertSee($threadByOsama->title)
            ->assertDontSee($threadNotByOsama->title );

    }



}
