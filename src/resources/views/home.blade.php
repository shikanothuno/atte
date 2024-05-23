@extends('layouts.layout')

@section('title')
    ホーム
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/home.css") }}">
@endsection
@section('content')
    <main id="main">
        <h2 class="message">{{ $user->name }}さんお疲れ様です！</h2>

    </main>
@endsection
