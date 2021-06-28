<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('homepage');

Route::name('user.')->group(function () {
    Route::view('/profile', 'profile')->middleware('auth')->name('profile');

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/signup', function () {
        return view('signup');
    })->name('signup');
});




