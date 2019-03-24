<?php
namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker ;
use App\Http\Controllers\UserController;

class RegistrationTest extends TestCase
{
// use RefreshDatabase;
// use WithoutMiddleware;
/**
* A basic test example
*
* @return void
*/
public function testExample()
{
$usercont = new UserController();
$usercont->login();
}
/**
* A basic test example.
*
* @group registration
* @return void
*/
// public function testRegistrationAccess()
// {
// $response = $this->actingAs($user)
// ->post('/api/login');
// $response->assertStatus(204);
// }
/**
* A test to test the registration validation
*
* @group registration
* @return void
*/
public function testRegistrationValidations()
{
$faker = Faker::create();
$response = $this->withHeaders([
'Content-Type' => 'Application/json',
])->json('POST', '/api/register', [
'firstname' => $faker->firstName(),
'lastname' => $faker->lastName(),
'email' => 'amanvermame@gmail.com',
'password' => 'asdf1234',
'c_password' => 'asdf1234'
]);
$response->assertStatus(210)->assertJsonCount(1)->assertExactJson([
"error" => [
"email" => [
"The email must be a valid email address."
]
]
]);
}
/**
* A test to test the registration succesfull
*
* {returns forst time on;y check if the user already exist}
*
* @group registration
* @return void
*/
public function testRegistrationSuccess()
{
$faker = Faker::create();
//form data as json to hit registraion api via post method
$response = $this->withHeaders([
'Content-Type' => 'Application/json',
])->json('POST', '/api/register', [
'firstname' => $faker->firstName(),
'lastname' => $faker->lastName,
'email' => $faker->email,
'password' => '123456789',
'rpassword' => '123456789'
]);
//checking status and json count and data
$response->assertStatus(201)->assertJsonCount(1)->assertExactJson([
"message"=> "registration succesfull"
]);
}
}