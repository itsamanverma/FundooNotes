<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Users;
use Laravel\passport\passport;

class NotesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
     /*
     * A test to check if notes can be created for a user or not
     *
     * @return void
     */
    public function testNoteCreate()
    {
        $user = factory(User::class)->create();
        //authenticating as the user
        Passport::actingAs($user);
 
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])->json('POST', '/api/createnote', [
            
            'title'=>'bgsdshjsgdgskjdgkjsgdgsj',
            'body'=>'jeloofdfhdf dfkkdf'
        ]);
 
        $response->assertStatus(201)->assertJson(['message' => 'Note Created']);
    }
}
