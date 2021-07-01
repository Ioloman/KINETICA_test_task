<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{!! Str::limit($post->text, 120) !!}</p>
    </div>
    <div class="card-footer text-muted clearfix">
        <div class="float-md-start">Автор: {{ $post->user->name }}</div>
        <div class="float-md-end">{{ $post->created_at->isoFormat('DD.MM.YYYY в hh:mm') }}</div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">An item</li>
        <li class="list-group-item">A second item</li>
        <li class="list-group-item">A third item</li>
    </ul>
    <div class="card-body">
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
    </div>
</div>


