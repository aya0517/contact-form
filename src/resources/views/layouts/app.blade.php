<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    FashionablyLate
                </a>

                <nav>
                    <ul class="header-nav">
                        @if (Request::is('login'))
                        <li class="header-nav__item">
                            <a href="/register" class="header-nav__button">register</a>
                        </li>
                        @elseif (Request::is('register'))
                        <li class="header-nav__item">
                            <a href="/login" class="header-nav__button">login</a>
                        </li>
                        @endif

                        @if (Auth::check())
                        <li class="header-nav__item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="header-nav__button">logout</button>
                            </form>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>