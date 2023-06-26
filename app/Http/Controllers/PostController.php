<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Posts;

class PostController extends Controller
{
   public function store(Request $request)
   {
    $validated = $request->validate([
      'title' => 'required|max:255',
      'message' => 'required'
    ]);

    $post = new Posts;
    $post->title = $request->title;
    $post->message = $request->message;
    $post->user_id = Auth::user()->id;
    $post->save();

   //  $validated['user_id'] = Auth::user()->id;

   //  Posts::create($validated);

    return back()->with('success', '投稿が正常に作成されました');
   }

  
}
