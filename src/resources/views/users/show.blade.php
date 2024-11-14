<!-- users/show.blade.php -->
@extends('layouts.app')

@section('content')
<h2>{{ $user->name }}の勤怠表</h2>
<div class="attendance-table">
    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->work_date->format('m/d')}}</td>
                    <td>{{ $attendance->start_time->format('H:i:s') }}</td>
                    <td>{{ $attendance->end_time ? $attendance->end_time->format('H:i:s') : '-' }}</td>
                    <td>{{ $attendance->total_break_time }}</td>
                    <td>{{ $attendance->work_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $attendances->links() }}
</div>
@endsection