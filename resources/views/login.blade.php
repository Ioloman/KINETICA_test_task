@extends('layouts.base')

@section('title')Вход@endsection

@section('content')
    <main role="main">
        <div class="container">
            <form class="form-group w-50 my-3" method="post" action="">
                @csrf
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" name="username" class="form-control">
                    <small class="form-text text-muted">Имя пользователя</small>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <p>Нет аккаунта? <a href="{{ route('signup') }}">Регистрация</a></p>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </main>
@endsection
