@extends('layouts.layout')

@section('title')
    勤怠記録
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/show-list.css") }}">
@endsection
@section('content')
    <main id="main">
        <div class="date-navigation">
            <a class="date-back-next" href="{{ route("showList",date("Y-m-d",strtotime($date . "-1 day"))) }}">&lt</a>
            <span class="date">{{ $date }}</span>
            <a class="date-back-next" href="{{ route("showList",date("Y-m-d",strtotime($date . "1 day"))) }}">&gt</a>
        </div>
        <div class="table__div">
            <table id="table">
                <tr>
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>

                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->start_time }}</td>
                        <td>{{ $attendance->end_time }}</td>
                        <td>{{ $attendance->calcWorkingTime($attendance->user->id,$date) }}</td>
                        <td>
                            @if ($attendance->end_time == null)
                                **:**:**
                            @else
                                {{ $attendance->getTotalBreakTime($attendance->user->id,$date) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $attendances->links("pagination.pagination-design") }}
    </main>
@endsection
