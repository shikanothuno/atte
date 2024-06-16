@extends('layouts.layout')

@section('title')
    404エラー
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/404.css") }}">
@endsection
@section('content')
    <main id="main">
       <div>エラーが発生しました<br>以下をクリックしてください。<br><a href="{{ route("attendance") }}">クリック</a></div>
    </main>
@endsection
