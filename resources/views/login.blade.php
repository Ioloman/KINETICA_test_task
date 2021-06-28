@extends('layouts.base')

@section('title')Вход@endsection

@section('content')
    <main role="main">
        <div class="container">
            <form class="form-group w-50 my-3" method="post" action="{{ route('user.login') }}">
                @csrf
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" name="name" class="form-control">
                    <small class="form-text text-muted">Имя пользователя</small>
                    @error('name')
                    <br>
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <p>Нет аккаунта? <a href="{{ route('user.signup') }}">Регистрация</a></p>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </main>
@endsection
