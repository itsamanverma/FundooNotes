<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
      $this->assertTrue(true);
    }

    /**
     * write the function to test the label creation 
     * 
     * @return void
     */
     public function testLabelCreate()
     {
        $user = factory(User::class)->create();
        //authenticating as the user
        Passport::actingAs($user);

        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])->json('POST', '/api/makelabel',[
            
            'label'=>'amansu label',
        ]);

        $response->assertStatus(201)->assertJson(['message' => 'Note Created']);
     }
}
