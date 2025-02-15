<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-form</title>
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

                <!-- ログインページなら register ボタンを表示 -->
                @if (Request::is('login'))
                <a href="/register" class="header__button">register</a>
                @endif

                <!-- 登録ページなら login ボタンを表示 -->
                @if (Request::is('register'))
                <a href="/login" class="header__button">login</a>
                @endif

                <nav>
                    <ul class="header-nav">
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <a href="/register" class="header-nav__button">Register</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="/login" class="header-nav__button">Login</a>
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