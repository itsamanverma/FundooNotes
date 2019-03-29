<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use App\PasswordReset;
use Illuminate\Http\Request;
use App\Notifications\PasswordResetRequest;
use Illuminate\Support\Carbon;

class PasswordResetController extends Controller
{
    /**
     * create the token password resert
     * 
     * @param [string] email
     * @return [string] message
     */
    public function create(Request $request){
      $validate = Validator::make($requrest->all(),[
        'email' => 'bail|required|email',
      ]);
      $user = User::where('email',$request->email)->first();
      if($user){
          return response()->json(['message'=> "we can't find a user with that email address."],200);
      }
      $passwordReset = PasswordReset::updateOrCreate(
          ['email'=>$user->email],
          [ 
            'email' => $user->email,
            'token' => str_random(60)
          ]
      );
      if($user && $passwordReset){
          $user->notify(new PasswordResetRequest($passwordReset->token));
      }
      return response()->json(['message' => 'we have emailed your password reset link to respective mailid'],201);
    }
    /**
     * find token password reset
     * 
     * @param  [string] token 
     * @return [string] message
     * @return [json] passwordReset Object
     */
      public function find(){
       $token = request('token');
       $passwordReset = PasswordReset::where('token',$token)->first();
       if(!$passwordReset){
              return response()->json(['message' => 'this password reset token is invalid'],200);
              
       }
       
     }
}
