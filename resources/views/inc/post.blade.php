<div class="card mb-3" id="post">
    <a href="{{ route('post.get', $post->id) }}">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ Str::limit(strip_tags($post->text), 120) }}</p>
        </div>
    </a>
    <div class="card-footer text-muted clearfix">
        <div class="float-md-start">Автор: {{ $post->user->name }}</div>
        <div class="float-md-end">{{ $post->created_at->isoFormat('DD.MM.YYYY в hh:mm') }}</div>
    </div>
    @if (count($post->comments))
    <div class="card-body">
        <h5>Последние комментарии:</h5>
        @foreach ($post->comments->sortByDesc('created_at') as $comment)
            @include('inc.comment', ['comment' => $comment])
            @break ($loop->iteration == 3)
        @endforeach
    </div>
    @endif
</div>


