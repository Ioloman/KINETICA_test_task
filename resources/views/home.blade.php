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
                    <a href="#"><h4><span class="badge bg-primary mb-3">Создать запись</span></h4></a>
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                        </div>
                        <div class="card-footer text-muted clearfix">
                            <div class="float-md-start">право</div>
                            <div class="float-md-end">лево</div>
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

                </div>
            </div>
        @endauth
    </div>
@endsection
