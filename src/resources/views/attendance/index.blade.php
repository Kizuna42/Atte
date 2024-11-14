@extends('layouts.app')

@section('content')
<div class="attendance-container">
    <h2>{{ $date ?? '' }}</h2>
    <div class="date-navigation">
        <a href="{{ route('attendance.index', ['date' => $prevDate]) }}" class="nav-arrow">&lt;</a>
        <span>{{ $currentDate }}</span>
        <a href="{{ route('attendance.index', ['date' => $nextDate]) }}" class="nav-arrow">&gt;</a>
    </div>
    <div class="attendance-table">
        <table>
            <thead>
                <tr>
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->start_time->format('H:i:s') }}</td>
                    <td>{{  $attendance->end_time ? $attendance->end_time->format('H:i:s') : '-' }}</td>
                    <td>{{ $attendance->total_break_time }}</td>
                    <td>{{ $attendance->work_time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        @for ($i = 1; $i <= $attendances->lastPage(); $i++)
        <a href="{{ route('attendance.index', ['date' => $currentDate, 'page' => $i]) }}" class="{{ $attendances->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
        @endfor
    </div>
</div>
@endsection