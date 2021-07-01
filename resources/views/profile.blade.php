@extends('layouts.base')

@section('title')Профиль@endsection

@section('content')
<div class="container py-4">
    <div class="p-5 mb-4 rounded-3 bg-light">
        <div class="container-fluid py-5">
            <p class="col-md-8 fs-4">Добро пожаловать, {{ Auth::user()->name }}!</p>
        </div>
    </div>
    <div class="p-5 mb-4 rounded-3 bg-light">
        <h4>Ваши посты:</h4>
        @forelse ($posts as $post)
            <a href="{{ route('post.get', $post->id) }}"><h5>{{ $post->title }} - {{ $post->created_at->isoFormat('DD.MM.YYYY в hh:mm') }}</h5></a>
        @empty
        У Вас пока нет постов :(
        @endforelse
    </div>
</div>
@endsection