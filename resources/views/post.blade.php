@extends('layouts.base')

@section('title'){{ $post->title }}@endsection

@section('content')
<div class="container py-4 w-75">
    <div class="p-5 mb-4 rounded-3 bg-light row">
        <div class="py-5">
            <h1 class="display-5 fw-bold text-break">{{ $post->title }}</h1>
            <p class="text-muted text-break">Автор: {{ $post->user->name }}</p>
            <small class="text-muted">{{ $post->created_at->isoFormat('DD.MM.YYYY в hh:mm') }}</small>
            <div class="col-md-8 fs-4 text-break">{!! $post->text !!}</div>
        </div>
    </div>

    <div class="row d-flex">
        <div class="col" id="commentSection">
            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h5>Комментарии (<data-counter>{{ count($post->comments) }}</data-counter>)</h5>
            </div>

            <div class="row">
                <div class="col-8"><input type="text" class="form-control" placeholder="Комментарий" id="comment" maxlength="500"></div>
                <div class="col-2"><button class="btn btn-primary" id="sendComment">Добавить</button></div>
            </div>
            
            @each('inc.comment', $post->comments->sortByDesc('created_at'), 'comment')
            
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script>
        $(document).ready(() => {
            // Для отправки post запроса устанавливаем в заголовок csrf токен
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /**
             * event handler для отправки комментария на сервер
             * с помощью ajax с последующей добавкой комментария (при успехе)
             * на страницу
             **/ 
            $('#sendComment').on('click', function () {
                // находим элемент, в котором находится комментарий
                const textfield = $('#comment');
                // если поле пустое
                if (textfield.val().length < 1)
                    alert('Введите что-нибудь!');
                else
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('post.addComment', $post->id) }}',
                        data: {user_id: {{ Auth::id() }}, text: textfield.val()}
                    }).done((data, textStatus, jqXHR) => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            // создаем jQuery элемент комментария
                            const comment = $(data);
                            comment.hide();
                            // вставляем его в DOM
                            const firstComment = $('div.card#comment:first');
                            if (firstComment.length > 0) 
                                firstComment.before(comment);
                            else
                                comment.appendTo($('#commentSection'));
                            // анимация добавления
                            comment.slideDown(400);
                            // обновляем счетчик комментариев
                            const counter = $('data-counter');
                            counter.text(Number.parseInt(counter.text()) + 1);
                            textfield.val('');
                        }
                    }).fail((jqXHR, textStatus, error) => {
                        alert(`${textStatus} - ${error}`)
                    });
            });
        })
    </script>
@endsection