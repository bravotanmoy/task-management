<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); // create login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = JWTAuth::attempt($credentials)) {
            return back()->withErrors(['msg' => 'Invalid credentials']);
        }

        // Store token in cookie
        return redirect()->route('dashboard')
            ->withCookie(cookie('token', $token, 60)); // 60 = minutes
    }

    public function dashboard()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return view('dashboard', compact('user'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->withCookie(cookie()->forget('token'));
    }
}