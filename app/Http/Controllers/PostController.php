<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
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

    public function comment(Request $request, Post $post){
        $validatedData = $request->validate([
            'user_id' => 'required',
            'text' => 'required|max:500|min:1'
        ]);

        $comment = new Comment();
        $comment->text = $validatedData['text'];
        $comment->user_id = $validatedData['user_id'];
        $comment->post_id = $post->id;
        $comment->save();

        if ($comment)
            return view('inc.comment', ['comment' => $comment]);
        else
            return response()->json(['error' => 'Комментарий не был добавлен']);
    }
}
