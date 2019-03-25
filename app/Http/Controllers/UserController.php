<?php
namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;

class UserController extends Controller
{
    public $successStatus = 200;
/**
 * login api
 *
 * @return \Illuminate\Http\Response
 */
    public function login()
    {
        $email = request('email');
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            if($user->email_verified_at === null){
               return  response()->json(['message' => 'Email Not verified'],211);
            }
            // $token = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 204);
        }
    }
/**
 * Register api
 *
 * @return \Illuminate\Http\Response
 */
    public function register(Request $request)
    {   
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:25',
            'lastname' => 'required|string|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:15',
            'c_password' => 'required|same:password',
        ]); 
        if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 201);
        }
        // $input = $request->all();
        $input['created_at'] = now();
        $input['password'] = bcrypt($input['password']);
        $input['verifytoken'] = str_random(60);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['firstname'] = $user->firstname;
        event(new UserRegistered($user,$input['verifytoken']));
        return response()->json(['success' => $success,'message' =>'registation successfull'], $this->successStatus);
    }
/**
 * details api
 *
 * @return \Illuminate\Http\Response
 */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
 