<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function register(Request $request){
        // Проверка если пользователь уже авторизован
        if (Auth::check()){
            return redirect(route('user.profile'));
        }

        // валидация данных
        $validation = $request->validate([
            'name' => 'required|min:4',
//            'password' => 'required|password',
            'password' => 'required',
        ]);

        // проверка чтобы имя было уникально
        if (User::where('name', $validation['name'])->exists()){
            return back()->withErrors([
                'name' => 'Данное имя пользователя уже занято'
            ]);
        }

        // создание пользователя и логин
        $user = User::create($validation);
        if ($user) {
            Auth::login($user);
            return redirect(route('user.profile'));
        }

        // если не удалось создать пользователя
        return back()->withErrors([
            'creationError' => 'Ошибка при создании пользователя.'
        ]);
    }
}
