<?php

namespace Tests\Feature;

use App\Favourite;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    /** Adding Reply
     */
    use DatabaseMigrations;


    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_authenticated_user_not_may_participate_in_forum_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/some-channel/1/replies', []);

    }

    /** @test */
    public function a_authenticated_user_may_participate_in_forum_thread()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $replay = make('App\Reply');

        $this->post($thread->path() . '/replies', $replay->toArray());

        $this->get($thread->path())
            ->assertSee($replay->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();
        $thread = create('App\Thread');
        $replay = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $replay->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
//    public function a_user_can_filter_thread_by_popularity()
//    {
//        $this->withoutMiddleware();
//
//        $threadWithTwoReplies = create('App\Thread');
//        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);
//
//        $threadWithThreeReplies = create('App\Thread');
//        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);
//
//
//        $threadWithNoReplies = $this->thread;
//
//        $response = $this->getJson('threads?popular=1')->json();
//
//        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
//    }


    /** @test */

    public function a_user_can_favorite_a_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');

        try {
            $this->post('replies/' . $reply->id . '/favourites', [
                'favourited_id' => $reply->id,
                'favourited_type' => 'App\Reply',]);
        } catch (\Exception $e) {
            $this->fail('Did not Except add the same record twice');
        }

        $this->assertCount(1, $reply->favourites);


    }
}
