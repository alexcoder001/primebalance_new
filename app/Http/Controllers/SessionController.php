<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // take input from user

        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'This credentials do not match our records.',
                'password' => 'This credentials do not match our records.',
            ]);
        }

        request()->session()->regenerate();

        return redirect('/dashboard');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
