<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'max:24'],
            'last_name' => ['required', 'string', 'max:24'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
