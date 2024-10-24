@extends('layouts.app')

@section('content')
<div class="attendance-container">
    <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>
    <div class="attendance-buttons">
        <form action="{{ route('attendance.start') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canStart ? '' : 'disabled' }}>勤務開始</button>
        </form>
        <form action="{{ route('attendance.end') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canEnd ? '' : 'disabled' }}>勤務終了</button>
        </form>
        <form action="{{ route('break.start') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canBreakStart ? '' : 'disabled' }}>休憩開始</button>
        </form>
        <form action="{{ route('break.end') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canBreakEnd ? '' : 'disabled' }}>休憩終了</button>
        </form>
    </div>
</div>
@endsection