@extends('layouts.app')

@section('content')
<div class="attendance-container">
    <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>
    <div class="attendance-buttons">
        <form action="{{ route('attendance.start') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canStart ? '' : 'disabled' }}>
                <span class="button-text">勤務開始</span>
            </button>
        </form>
        <form action="{{ route('attendance.end') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canEnd ? '' : 'disabled' }}>
                <span class="button-text">勤務終了</span>
            </button>
        </form>
        <form action="{{ route('break.start') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canBreakStart ? '' : 'disabled' }}>
                <span class="button-text">休憩開始</span>
            </button>
        </form>
        <form action="{{ route('break.end') }}" method="POST">
            @csrf
            <button type="submit" class="attendance-button" {{ $canBreakEnd ? '' : 'disabled' }}>
                <span class="button-text">休憩終了</span>
            </button>
        </form>
    </div>
</div>
@endsection