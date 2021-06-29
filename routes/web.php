<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Главная страница
Route::get('/', function () {
    return view('home');
})->name('homepage');

/**
 * Группа ссылок, для работы с пользователем
 */
Route::name('user.')->group(function () {
    // Профиль, доступный только авторизованным пользователям, благодаря middleware auth
    Route::view('/profile', 'profile')->middleware('auth')->name('profile');

    // Страница входа
    Route::get('/login', function () {
        if (Auth::check())
            return redirect(\route('user.profile'));
        return view('login');
    })->name('login');

    // Страница регистрации
    Route::get('/signup', function () {
        if (Auth::check())
            return redirect(\route('user.profile'));
        return view('signup');
    })->name('signup');

    // Контроллер регистрации
    Route::post('/signup', [RegistrationController::class, 'register']);

    // Выход из аккаунта
    Route::get('/logout', function (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(\route('homepage'));
    })->name('logout');

    // Контроллер логина
    Route::post('/login', [LoginController::class, 'login']);
});

/**
 * TODO:
 * Создание
 * Отображение
 * Отдельное отображение
 * Добавление комментов
 * Изменение, удаление всего?
 */



