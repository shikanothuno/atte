@extends('layouts.layout')

@section('title')
    カレンダー
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/calendar.css") }}">
@endsection
@section('content')
    <main id="main">
        {{ $target_month }}
        <table>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>

            @for ($i = 0; $i < 5; $i++)
                <tr>
                @for ($j = 0; $j < 7; $j++)
                    <td><a href="{{ route("showList",$days[$i*7+$j]->format("Y-m-d")) }}">
                        {{ $days[$i*7+$j]->format("d") }}</a></td>
                @endfor
                </tr>
            @endfor
        </table>
    </main>
@endsection
