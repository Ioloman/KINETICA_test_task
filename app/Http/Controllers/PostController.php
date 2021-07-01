<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required'
        ]);

        $post = new Post();
        $post->text = $validatedData['text'];
        $post->title = $validatedData['title'];
        $post->user_id = Auth::id();
        $post->save();

        if ($post)
            return view('inc.post', ['post' => $post]);
        else
            return response()->json(['error' => 'Пост не был создан']);
    }
}
