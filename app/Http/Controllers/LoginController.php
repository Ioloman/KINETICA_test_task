<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        // проверка если пользователь уже авторизован
        if (Auth::check())
            return redirect()->intended(route('user.profile'));

        // получаем данные для входа
        $credentials = $request->only('name', 'password');

        // составляем запрос к БД
        $query = User::where('name', $credentials['name'])->where('password', $credentials['password']);

        // если пользователь найден - входим
        if ($query->exists()) {
            Auth::login($query->first());
            return redirect()->intended(route('user.profile'));
        }

        // если не удалось найти пользователя
        return back()->withErrors([
            'name' => 'Предоставленные данные не подходят.',
        ]);
    }
}
