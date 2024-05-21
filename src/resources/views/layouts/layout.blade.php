<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset("css/sanitize.css") }}">
        @yield('css')

    </head>
    <header>
        @extends('layouts.header')
    </header>

    @yield('content')
    <footer>
        @extends('layouts.footer')
    </footer>
</html>
