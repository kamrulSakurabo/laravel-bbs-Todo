<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

use App\Models\User;

class LoginController extends Controller
{
     // Show functions in home page navbar
     public function showLoginForm(){
        return view('auth.login');
    }

    // login function
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            if(Auth::user()->hasVerifiedEmail()){
                return redirect()->intended('/home');
            } else{
                Auth::logout();
                return back()->withErrors(['email' => 'You need to verify your email address!']);
            }
            
        }
        return back()->withErrors([
            'email' =>  'The provided credentials do not match our records.'
        ]);
    }
    

    // logout function

    public function logout(Request $request):RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
