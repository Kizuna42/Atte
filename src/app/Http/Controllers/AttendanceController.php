<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date') ? Carbon::parse($request->get('date')) : Carbon::today();

        $attendances = Attendance::with(['user', 'breaktimes']) // breaks() -> breaktimes()
            ->whereDate('work_date', $date)
            ->orderBy('start_time')
            ->paginate(10);

        return view('attendance.index', [
            'attendances' => $attendances,
            'currentDate' => $date->format('Y/m/d'),
            'prevDate' => $date->copy()->subDay()->format('Y-m-d'),
            'nextDate' => $date->copy()->addDay()->format('Y-m-d')
        ]);
    }

    public function start()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $exists = Attendance::where('user_id', $user->id)
            ->whereDate('work_date', $today)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', '既に今日の勤務は開始されています。');
        }

        Attendance::create([
            'user_id' => $user->id,
            'work_date' => $today,
            'start_time' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', '勤務を開始しました。');
    }

    public function end()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('work_date', $today)
            ->whereNull('end_time')
            ->first();

        if (!$attendance) {
            return redirect()->back()->with('error', '開始されている勤務がありません。');
        }

        $hasOngoingBreak = $attendance->breaktimes() // breaks() -> breaktimes()
            ->whereNull('end_time')
            ->exists();

        if ($hasOngoingBreak) {
            return redirect()->back()->with('error', '休憩中は勤務を終了できません。');
        }

        $attendance->update([
            'end_time' => Carbon::now()
        ]);

        return redirect()->back()->with('success', '勤務を終了しました。');
    }
}