<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\User;
use App\PasswordReset;
use Illuminate\Http\Request;
use App\Notifications\PasswordResetRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/forgotpassword",
     *     summary="Request a password reset email",
     *     tags={"Password"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Password reset email sent"),
     *     @OA\Response(response=200, description="User not found")
     * )
     * create the token password resert
     * @param [string] email
     * @return [string] message
     */
    public function create(Request $request){
      $validate = Validator::make($request->all(),[
        'email' => 'bail|required|email',
      ]);     
      $user = User::where('email',$request->email)->first();
      if(!$user){
          return response()->json(['message'=> "we can't find a user with that email address."],200);
      }
      $passwordReset = PasswordReset::updateOrCreate(
          ['email'=>$user->email],
          [ 
            'email' => $user->email,
            'token' => Str::random(60)
          ]
      );
      if($user && $passwordReset){
          $user->notify(new PasswordResetRequest($passwordReset->token));
      }
      return response()->json(['message' => 'we have emailed your password reset link to respective mailid'],201);
    }
    /**
     * @OA\Post(
     *     path="/api/forgotpassword/find",
     *     summary="Find a password reset token",
     *     tags={"Password"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"token"},
     *             @OA\Property(property="token", type="string", example="reset-token-value")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Token valid"),
     *     @OA\Response(response=200, description="Token invalid")
     * )
     * find token password reset
     * @param  [string] token 
     * @return [string] message
     * @return [json] passwordReset Object
     */
      public function find(){
       $token = request('token');
       $passwordReset = PasswordReset::where('token',$token)->first();
       if(!$passwordReset)
              return response()->json([
                'message' => 'this password reset token is invalid'],200);
                if(Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()){
                $passwordReset->delete();
                return response()->json(['message' => 'this password reset token is invalid'],200);
              }
           return response()->json(['message' => $passwordReset],201);
     }

    /**
     * @OA\Post(
     *     path="/api/forgotpassword/reset",
     *     summary="Reset password",
     *     tags={"Password"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password","c_password","token"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", minLength=8, maxLength=15, example="newpassword123"),
     *             @OA\Property(property="c_password", type="string", minLength=8, maxLength=15, example="newpassword123"),
     *             @OA\Property(property="token", type="string", example="reset-token-value")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Password reset successful"),
     *     @OA\Response(response=200, description="Token or user invalid")
     * )
     * Reset password
     * @param [string] email
     * @param [string] password
     * @param [string] password_conformation
     * @param [string] token
     * @return [string] message
     * @return [json] user object 
     */
      public function reset(Request $request){
       $validate = Validator::make($request->all(),[
          'password' => 'required|min:8|max:15',
          'c_password' => 'required|same:password'
       ]);
       if($validate->fail()){
        return response()->json(['message'=>"passwor doesn't match"],201);  
       }
       $passwordReset = PasswordReset::where([
         ['token',$request->token]
       ])->first();
       if(!$passwordReset)
       return response()->json(['message' => 'this password token is invalid'],200);
       $user = User::where('email',$passwordReset->email)->first();
       if(!$user)
       return response()->json(['message' =>"we can't find the user with that e-mail address"],200);
       $user->password = bcrypt($request->password);
       $user->save();
       $passwordReset->delete();
       return response()->json(['message' =>'password Reset Successfuly!'],201);
      }
}
