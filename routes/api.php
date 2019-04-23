<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group([
//     'prefix' => 'auth'
// ], function () {
//     Route::post('login', 'AuthController@login');
//     Route::post('signup', 'AuthController@signup');
    
//     Route::group([
//       'middleware' => 'auth:api'
//     ], function() {
//         Route::get('logout', 'AuthController@logout');
//         Route::get('user', 'AuthController@user');
//     });
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'UserController@login')->name('login');
Route::post('register', 'UserController@register');
Route::get('verifyemail/{token}','UserController@verifyEmail');
Route::post('forgotpassword','PasswordResetController@create');
Route::post('forgotpassword/find','PasswordResetController@find');
Route::post('forgotpassword/reset','PasswordResetController@reset');
Route::post('sociallogin', 'UserController@socialLogin');

/**
 * for authentication checking authentication users
 * @
 */

Route::group(['middleware' => 'auth:api'], function(){
Route::get('userDetails', 'UserController@userDetails');
Route::get('/logout','UserController@logout');
Route::get('/getnotes','NotesController@getNotes');
Route::post('/createnote','NotesController@create');
Route::post('/editnote','NotesController@editNotes');
Route::post('/deletenote','NotesController@deleteNote'); 
Route::post('/makelabel', 'LabelController@makeLabel');
Route::post('/editlabel', 'LabelController@editLabel');


});