<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return view('home');
});

// Register Router
Route::get('register', [ RegistrController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegistrController::class, 'register'])->name("register");

// login router
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login',[LoginController::class, 'login'])->name('login');

// logout route
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

// Email verification route
Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request){
    $request->fulfill();

    return redirect('/home');
   // return redirect(RouteServiceProvider::HOME);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request){
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message','Verification link sent!');
})->middleware(['auth','throttle:6,1' ])->name('verification.send');

Route::group(['middleware' => ['auth']], function (){
    // Post stored Route
    Route::get('/post', function(){
        return redirect('/');
    })->name('post');
    Route::post('/post', [PostController::class, 'store'])->name('post.store')->middleware('auth', 'verified');

    // post view route
    Route::get('home',[HomeController::class, 'posts'])->name('home');

});




