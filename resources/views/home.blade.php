@extends('layouts.base')

@section('title')Блог@endsection

@section('content')
    <div class="container py-4">
        @guest
            <div class="p-5 mb-4 rounded-3 bg-light">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Блог</h1>
                    <p class="col-md-8 fs-4">Для просмотра содержимого необходимо зарегистрироваться или войти.</p>
                    <a class="btn btn-primary btn-lg" type="button" href="{{ route('user.login') }}">Вход</a>
                </div>
            </div>
        @endguest

        @auth
            <div class="row">
                <div class="my-3 col-12 col-sm-10 col-md-9 col-lg-7 mx-auto p-5 mb-4 rounded-3 bg-light">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#textEditorModal"><h4><span class="badge bg-primary mb-3">Создать запись</span></h4></a>

                    <div class="modal fade" id="textEditorModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Создать пост</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-2">Название: </label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" placeholder="Название поста" id="title" maxlength="255">
                                        </div>
                                    </div>
                                    <textarea name="text" id="textEditor" cols="60" rows="40"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="editorSend">Опубликовать</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @each('inc.post', $posts, 'post')

                    {{ $posts->onEachSide(3)->links('pagination::bootstrap-4') }}

                </div>
            </div>
        @endauth
    </div>
@endsection

@section('javascript')
    <script src="{{ URL::to('js/packages/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(() => {
            const editor_config = {
                path_absolute: "{{ URL::to('/') }}/",
                selector: "textarea#textEditor",
                language: "ru",
                height: 400,
                plugins: [
                    "advlist autolink lists link charmap print hr anchor pagebreak",
                    "searchreplace visualblocks visualchars",
                    "insertdatetime nonbreaking save contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false
            };
            tinyMCE.init(editor_config);
        })
    </script>
    <script>
        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#editorSend').on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('post.create') }}',
                    data: {title: $('#title').val(), text: tinyMCE.get('textEditor').getContent()}
                }).done((data, textStatus, jqXHR) => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Добавить в начало созданный пост и убрать с конца последний
                        const card = $(data);
                        card.hide();
                        const lastCard = $('div.card#post:last');
                        const firstCard =  $('div.card#post:first');
                        if (firstCard.length > 0)
                            firstCard.before(card);
                        else
                            card.insertAfter($('#textEditorModal'));
                        card.slideDown(400);
                        if (lastCard.length > 0){
                            lastCard.slideUp(400);
                            lastCard.remove();
                        }
                    }
                }).fail((jqXHR, textStatus, error) => {
                    alert(`${textStatus} - ${error}`)
                });
                bootstrap.Modal.getInstance(document.getElementById('textEditorModal')).hide();
            });
        })
    </script>
@endsection
