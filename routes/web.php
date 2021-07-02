<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', function () {
    return view('home', ['posts' => Post::orderBy('created_at', 'DESC')->paginate(10)]);
})->name('homepage');

/**
 * Группа ссылок, для работы с пользователем
 */
Route::name('user.')->group(function () {
    // Профиль, доступный только авторизованным пользователям, благодаря middleware auth
    Route::get('/profile', function (){
        return view('profile', ['posts' => Post::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get()]);
    })->middleware('auth')->name('profile');

    // Страница входа
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect(\route('user.profile'));
        }

        return view('login');
    })->name('login');

    // Страница регистрации
    Route::get('/signup', function () {
        if (Auth::check()) {
            return redirect(\route('user.profile'));
        }

        return view('signup');
    })->name('signup');

    // Контроллер регистрации
    Route::post('/signup', [RegistrationController::class, 'register']);

    // Выход из аккаунта
    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(\route('homepage'));
    })->name('logout');

    // Контроллер логина
    Route::post('/login', [LoginController::class, 'login']);
});

// Группа действий с постом
Route::name('post.')->middleware('auth')->group(function () {
    // Контроллер для создание поста
    Route::post('/new-post', [PostController::class, 'create'])->name('create');

    // View поста
    Route::get('/post/{post}', function (Post $post) {
        return view('post', ['post' => $post]);
    })->name('get');

    // Контроллер создания комментария
    Route::post('/post/{post}/comment', [PostController::class, 'comment'])->name('addComment');
});
