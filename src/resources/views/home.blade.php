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
        <div class="month-navigation">
            <a class="month-back-next" href="{{ route("home",date("Y-m",strtotime($target_month . " -1 month"))) }}">&lt</a>
            <span class="month">{{ $target_month }}</span>
            <a class="month-back-next" href="{{ route("home",date("Y-m",strtotime($target_month . " +1 month"))) }}">&gt</a>
        </div>
        <div class="table__div">
            <table id="table">
                <tr>
                    <th>日付</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>勤務時間</th>
                    <th>休憩時間</th>
                </tr>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $loop->iteration }}日</td>
                        <td>{{ $attendance->start_time }}</td>
                        <td>{{ $attendance->end_time }}</td>
                        <td>{{ $attendance->calcWorkingTime($user->id,date("Y-m-d",strtotime($target_month . "-01" . " +" . strval($loop->index) . "day"))) }}</td>
                        <td>{{ $attendance->getTotalBreakTime($user->id,date("Y-m-d",strtotime($target_month . "-01" . " +" . strval($loop->index) . "day"))) }}</td>
                    </tr>
                @endforeach

            </table>

        </div>
    </main>
@endsection