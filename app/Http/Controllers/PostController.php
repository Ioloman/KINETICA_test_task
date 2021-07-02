<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Контроллер для создания поста
     *
     * @param Request $request
     */
    public function create(Request $request){
        // валидация данных
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required'
        ]);

        // создаем пост
        $post = new Post();
        $post->text = $validatedData['text'];
        $post->title = $validatedData['title'];
        $post->user_id = Auth::id();
        $post->save();

        // в случае успеха возвращаем html поста
        if ($post)
            return view('inc.post', ['post' => $post]);
        else
            return response()->json(['error' => 'Пост не был создан']);
    }

    /**
     * Контроллер создания комментария
     *
     * @param Request $request
     * @param Post $post: Модель поста к которому добавляется комментарий
     */
    public function comment(Request $request, Post $post){
        // валидация данных
        $validatedData = $request->validate([
            'user_id' => 'required',
            'text' => 'required|max:500|min:1'
        ]);

        // создаем комментарий
        $comment = new Comment();
        $comment->text = $validatedData['text'];
        $comment->user_id = $validatedData['user_id'];
        $comment->post_id = $post->id;
        $comment->save();
        
        // в случае успеха возвращаем html комментария
        if ($comment)
            return view('inc.comment', ['comment' => $comment]);
        else
            return response()->json(['error' => 'Комментарий не был добавлен']);
    }
}
