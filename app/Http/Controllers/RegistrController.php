<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;

use App\Models\User;

class RegistrController extends Controller
{
    // Show functions in home page navbar
    public function showRegistrationForm(){
        return view('auth.register');
    }

    // Register function
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);
        
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        event(new Registered($user));
        //return redirect()->route('login.form');
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
        //return redirect()->route('verification.notice');
    }

  
}
