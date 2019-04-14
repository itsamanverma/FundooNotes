<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
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
            'userid' => '3',
            'title'=>'notes test',
            'body'=>'test the notes creation',
            'index'=>'5',
            'color'=> 'yellow',
            'reminder' => 'reminde me at 6'
        ]);
 
        $response->assertStatus(201)->assertJson(['message' => 'Note Created']);
    }
}
