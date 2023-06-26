<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;

class HomeController extends Controller
{
   public function posts()
   {
    $posts = Posts::where('user_id', Auth::user()->id)
    ->orderBy('created_at', 'desc')
    ->get();
    return view('home', compact('posts'));
   }
    
}
