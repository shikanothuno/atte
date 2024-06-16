@extends('layouts.layout')

@section('title')
    419エラー
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/419.css") }}">
@endsection
@section('content')
    <main id="main">
       <div>エラーが発生しました<br>以下をクリックしてください。<br><a href="{{ route("attendance") }}">クリック</a></div>
    </main>
@endsection
