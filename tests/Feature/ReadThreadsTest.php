<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }
    
    /** @test */
    public function a_user_can_view_all_threads()
    {
        // $response = $this->get('/threads');
        // $response->assertSee($this->thread->title);
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_single_thread()
    {
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_replies_that_are_associated_with_a_thread()
    {
        //Given we have a thread
        //and that thread includes replies
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        //when we visit a thread page
        //then we should see the replies.
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }
}
