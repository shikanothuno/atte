@extends('layouts.layout')

@section('title')
    ログイン
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/login.css") }}">
@endsection
@section('content')
    <body id="body">
        <main id="main">
            <div class="parent">
                <form action="{{ route("login") }}" method="POST">
                    @csrf
                    <h2>ログイン</h2>
                    <input class="child__input" type="text" name="email" placeholder="メールアドレス">
                    <input class="child__input" type="password" name="password" placeholder="パスワード">
                    <button class="child__button">会員登録</button>
                    <p class="child__p">アカウントをお持ちでない方はこちらから</p>
                    <a class="child__a" href="{{ route("register") }}">会員登録</a>
                </form>
            </div>

        </main>
    </body>
@endsection
