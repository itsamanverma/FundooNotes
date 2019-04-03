<?php
namespace Tests\Feature; 

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class VerifyEmailTest extends TestCase
{
/**
* A basic test example.
*
* @return void
*/
public function testExample()
{
$this->assertTrue(true);
}
/**
* test to verify that the verify mail of the user is working
*
* @group verifyemail
* @return void
*/
public function testVerifyEmailSuccess()
{
$user = User::where('email', 'amanvermame786@gmail.com')->first();
$token = $user->verifytoken;
var_dump($token);
$user->email_verified_at = null;
$user->save();
$response = $this->withHeaders([
'Content-Type' => 'Application/json',
])->json('POST', '/api/verifyemail', [
"token" => $token
]);
$response->assertStatus(201)->assertExactJson([
"message" => "Email Successfully Verified"
]);
 }
/**
* test to verify the email is already verified
* @group verifyemail
*
* @return void
*/
public function testVerifyEmailAlreadyVerified()
{
$user = User::where('email', 'amanvermame786@gmail.com')->first();
$token = $user['verifytoken'];
var_dump($token);
$response = $this->withHeaders([
'Content-Type' => 'Application/json',
])->json('POST', '/api/verifyemail', [
"token" => $token
]);
$response->assertStatus(202)->assertExactJson([
"message" => "Email Already Verified"
]);
}
/**
* test to verify the email is not in database or token is invalid
* @group verifyemail
*
* @return void
*/
public function testVerifyEmailTokenInvalid()
{
$token = 'hdghjgfdgigfdydhfhf1x34';
$response = $this->withHeaders([
'Content-Type' => 'Application/json',
])->json('POST', '/api/verifyemail', [
"token" => $token
]);
$response->assertStatus(200)->assertJsonCount(1)->assertExactJson([
"message" => "Not a Registered Email"
]);
 }
}
