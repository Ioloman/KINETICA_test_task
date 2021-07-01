<div class="card p-3 mt-2" id="comment">
    <div class="d-flex justify-content-between align-items-center">
        <div class="user d-flex flex-row align-items-center">
            <span>
                <small class="font-weight-bold text-primary">{{ $comment->user->name }}</small> <br>
                <small class="font-weight-bold">{{ $comment->text }}</small>
            </span> 
        </div> 
        <small>{{ $comment->created_at->isoFormat('DD.MM.YYYY в hh:mm') }}</small>
    </div>
    <div class="action d-flex justify-content-between mt-2 align-items-center">
        {{-- <div class="reply"> 
            <small>Удалить</small> 
        </div> --}}
    </div>
</div>