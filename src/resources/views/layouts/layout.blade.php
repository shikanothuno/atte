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
                <table class="header__table">
                    <tr>
                        <td><a class="nav__a" href="/home">ホーム</a></td>
                        <td><a class="nav__a" href="{{ route("calendar.show",date("Y-m")) }}">日付一覧</a></td>
                        <td>
                            <form method="POST" action="{{ route("logout") }}">
                                @csrf
                                <button class="logout-button">ログアウト</button>
                            </form>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </header>

        @yield('content')
        <footer>
            @extends('layouts.footer')
        </footer>
    </body>
</html>
