@extends('layouts.base')

@section('title')Регистрация@endsection

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
                    <input type="password" name="password1" class="form-control">
                </div>
                <div class="form-group">
                    <label>Повторите пароль</label>
                    <input type="password" name="password2" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Регистрация</button>
            </form>
        </div>
    </main>
@endsection
