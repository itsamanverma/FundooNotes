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
  * write the test to test the registration validation  * 
  *
  * @group registration 
  * @return void  
  */
  public function test_Registration_Validations(){
         $faker = Faker::create();
         $response = $this->withHeaders([
         'Content-type' => 'Application/json',
           ])->json('POST','/api/register',[
          'firstname' => $faker->firstName(),
          'lastname' => $faker->lastName,
          'email' => 'amanvermame786@gmail.com',
          'password' => 'asdf1234',
          'c_password' => 'asdf1234'
          ]);
          var_dump('email');
          $response->assertStatus(201)->assertJsonCount(1)->assertExactJson([
         "error" => [
             "email" => [
                      "this email must be valid email address."
             ]
         ]
     ]);
   }
/**
 * simple  test of registration 
 * 
 * 
 * @group 
 * @return void
 */
public function testRegistration(){
           
  $response = $this->json('POST', '/api/register', [
     ]);
    $response->assertStatus(201);
  }
   
  /**
   * test the registration with valid term
   * 
   * @group Registration
   * @return void
   */
  public function testRegistrationSuccess(){
    $faker  = Faker::create();
    
    $response = $this->withHeaders([
      'Content-type' => 'Application/json',
    ])->json('POST','/api/register',[
      'firstname' => $faker->firstName(),
      'lastname' => $faker->lastName,
      'email' => $faker->email,
      'password'=> 'asdfghjk',
      'c_password' =>'asdfghjk'
    ]);

    $response->assertStatus(201)->assertJsonCount(1)->assertExactJson([
       "message" => "Registration Successfull!"
     ]);
  }
/**
 * test function for validator using the faker class
 */
  public function testRegistrationValidations(){
     $faker = Faker::create();
     $data = [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->email,
        'password' => 'asdf1234',
        'c_password' => 'asdf1234'
      ];

       $this->post(('/api/register'), $data)
        ->assertStatus(201)
        ->assertJson($data);
  }

  /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $response = $this->json('POST', '/api/register', [
          'firstname' => 'aman',
          'lastname' => 'verma',
          'email' => 'amanvermame786@gmail.com',
          'password' => 'asdf1234',
          'c_password' => 'asdf1234'
           ]);

        $response
            ->assertStatus(201)
            ->assertExactJson([
                'created' => true,
            ]);
    }

}