<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homepage') }}">Блог</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(Request::url() === route('homepage'))active @endif"
                       href="{{ route('homepage') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::url() === route('user.profile'))active @endif"
                       href="{{ route('user.profile') }}">Личный Кабинет</a>
                </li>
            </ul>
            @guest
                <a class="btn btn-primary" href="{{ route('user.login') }}">
                    Вход
                </a>
            @endguest
            @auth
                <a class="btn btn-primary" href="{{ route('user.logout') }}">
                    Выйти
                </a>
            @endauth
        </div>
    </div>
</nav>
