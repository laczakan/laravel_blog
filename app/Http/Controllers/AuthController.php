<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Login form
    public function login()
    {
        return view('auth.login');
    }

    // Save credentials to session
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:4', 'max:32'],
        ]);

        $validator->after(function ($validator) use ($credentials) {
            if (!Auth::attempt($credentials)) {
                $validator->errors()->add('password', 'Wrong password!');
            }
        });

        if ($validator->fails()) {
            return redirect('auth/login')
                ->withErrors($validator)
                ->withInput();
        } else {
            return redirect('')->with('success', 'You are logged in!');
        }
    }

    // Delete session credentials
    public function logout()
    {
        Auth::logout();

        return redirect('')->with('success', 'You are logged off. See you soon!');
    }

}
