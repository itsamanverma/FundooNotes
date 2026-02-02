<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// Note: Laravel 9 Auth scaffolding has changed. 
// Install laravel/ui if you need traditional auth controllers

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails; // Commented out - not available in Laravel 9

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
