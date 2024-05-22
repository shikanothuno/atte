<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset("css/sanitize.css") }}">
        <link rel="stylesheet" href="{{ asset("css/header.css") }}">
        @yield('css')

    </head>
    <body id="body">
        <header>
            <div class="header">
                <div class="logo">Atte</div>
                @if (Request::routeIs("attendance")||Request::routeIs("showList"))
                <nav>
                    <ul>
                        <li><a href="/home">ホーム</a></li>
                        <li><a href="/date">日付一覧</a></li>
                        <li>
                            <form method="POST" action="{{ route("logout") }}">
                                @csrf
                                <button class="logout-button">ログアウト</button>
                            </form>

                        </li>
                    </ul>
                </nav>
                @endif
            </div>
        </header>

        @yield('content')
        <footer>
            @extends('layouts.footer')
        </footer>
    </body>
</html>
