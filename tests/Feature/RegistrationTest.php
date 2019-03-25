<?php
namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use App\Http\Controllers\UserController;

class RegistrationTest extends TestCase
{
/**
* A basic test example
*
* @return void
*/
 public function testExample()
{
$userRegister = new UserController();
$userRegister->login();
$this->assertTrue(true);
}
/**
 * write the test to test the registration validation
 * 
 * @group registration 
 * @return void  
 */
  public function testRegistrationValidations(){
    $faker = Faker::create();
    $response = $this->withHeaders([
        'Content-type' => 'Application/json',
    ])->json('POST','/api/register',[
      'firstname' => $faker->firstName(),
      'lastname' => $faker->lastName,
      'email' => 'asdasdasd@ccxzkc',
      'password' => 'asdf1234',
      'c_password' => 'asdf1234'
    ]);

    $response->assertStatus(210)->assertJsonCount(5)->assertExactJson([
        "error" => [
            "email" => [
                     "this email must be valid email address."
            ]
        ]
    ]);
  }
}