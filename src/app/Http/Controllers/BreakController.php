<?php

namespace App\Http\Controllers;

use App\Models\Breaktime; // Breaktime モデルを使用
use App\Models\Attendance;
use Carbon\Carbon;

class BreakController extends Controller
{
    public function start()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('work_date', $today)
            ->whereNull('end_time')
            ->first();

        if (!$attendance) {
            return redirect()->back()->with('error', '勤務が開始されていません。');
        }

        $hasOngoingBreak = $attendance->breaks()
            ->whereNull('end_time')
            ->exists();

        if ($hasOngoingBreak) {
            return redirect()->back()->with('error', '既に休憩中です。');
        }

        // Breaktime モデルを使用して休憩を開始
        Breaktime::create([
            'attendance_id' => $attendance->id,
            'start_time' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', '休憩を開始しました。');
    }

    public function end()
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Breaktime モデルを使用して休憩を終了
        $break = Breaktime::whereHas('attendance', function($query) use ($user, $today) {
            $query->where('user_id', $user->id)
                ->whereDate('work_date', $today);
        })
        ->whereNull('end_time')
        ->first();

        if (!$break) {
            return redirect()->back()->with('error', '開始されている休憩がありません。');
        }

        $break->update([
            'end_time' => Carbon::now()
        ]);

        return redirect()->back()->with('success', '休憩を終了しました。');
    }
}