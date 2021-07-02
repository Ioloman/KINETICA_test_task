<div class="card mb-3" id="post">
    <a href="{{ route('post.get', $post->id) }}">
        <div class="card-body">
            <h5 class="card-title text-break">{{ $post->title }}</h5>
            <p class="card-text text-break">{{ Str::limit(strip_tags($post->text), 120) }}</p>
        </div>
    </a>
    <div class="card-footer text-muted clearfix">
        <div class="float-md-start text-break">Автор: {{ $post->user->name }}</div>
        <div class="float-md-end">{{ $post->created_at->isoFormat('DD.MM.YYYY в hh:mm') }}</div>
    </div>
    @if (count($post->comments))
    <hr>
    <h5>Последние комментарии:</h5>
    <ul class="list-group list-group-flush">
        @foreach ($post->comments->sortByDesc('created_at') as $comment)
            <li class="list-group-item">
                <small class="font-weight-bold text-primary text-break">{{ $comment->user->name }}</small> <br>
                <small class="font-weight-bold text-break">{{ $comment->text }}</small><br>
                <small class="text-muted">{{ $comment->created_at->isoFormat('DD.MM.YYYY в hh:mm') }}</small>
            </li>
            @break ($loop->iteration == 3)
        @endforeach
    </ul>
    @endif
</div>


