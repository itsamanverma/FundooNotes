<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     * @group login 
     * @return void
     */
    public function testExample()
    {
        $response->assertTrue(true);
    }
    /**
     * check the login without using auth
     * @group login
     */
    public function test_Login_Guest()
    {
      $response = $this->post('/api/login');

      $response->assertStatus(204);
    }
}
