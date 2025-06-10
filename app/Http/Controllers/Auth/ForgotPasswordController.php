<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;



class ForgotPasswordController extends Controller
{
    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Handle forgot password form submission
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        // Define a unique key for throttling
        $key = 'password_reset_' . Str::lower($request->email);
    
        // Reduce the throttle time to 10 seconds
        RateLimiter::for('password-reset', function () {
            return Limit::perMinute(6); // Allow 6 requests per minute (every 10 sec)
        });
    
        // Check if the user is throttled
        if (RateLimiter::tooManyAttempts($key, 1)) {
            return back()->withErrors(['email' => 'Please wait 10 seconds before retrying.']);
        }
    
        // Reset the throttle limit
        RateLimiter::hit($key, 10); // Set the cooldown time to 10 seconds
    
        $status = Password::sendResetLink($request->only('email'));
    
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('message', 'Reset link sent to your email!');
        }
    
        return back()->withErrors(['email' => __($status)]);
    }
}


