<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PagesController@index');    
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts','PostsController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/listview', function ($id) {
    return view('/listview');
});

Route::get('/upload', 'VideoUploadController@showUploadForm');
Route::post('/upload', 'VideoUploadController@storeUploads');