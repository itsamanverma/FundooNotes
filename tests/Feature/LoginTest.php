<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
/**
* A basic test example.
* @group login
* @return void
*/
public function testExample()
{
$this->assertTrue(true);
}
/**
* Check if login without using auth
*
* @group login
*/
public function test_Login_Guest()
{
    //Geven
       //user is authenticated
    //when
    // $response = $this->post('/api/login');
    $response = $this->json('POST','/api/login',[
    ]);
    //then
      //check if guest cannot login as rsponse code is 204
      $response->assertStatus(204);
  }
/**
* check if user can login or not
*
* @group login
*/
public function test_Login_User()
{
$user = factory(User::class)->create();
// $response = $this->actingAs($user)->post('/api/login');
$response = $this->actingAs($user)->json('POST','/api/login');
$response->assertStatus(204);
}
/**
* check if user can login or not
*
* @group login
*/
public function test_Login()
{
$user = factory(User::class)->create();
// $response = $this->actingAs($user)->post('/api/login');
$response = $this->actingAs($user)->json('POST','/api/login');
$response->assertStatus(204);
}
/**
*
* @group login
*/
// public function testLogin
}