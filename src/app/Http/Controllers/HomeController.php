<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Breaktime;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('work_date', $today)
            ->first();

        $break = Breaktime::whereHas('attendance', function($query) use ($user, $today) {
            $query->where('user_id', $user->id)
                ->whereDate('work_date', $today);
        })
        ->whereNull('end_time')
        ->first();

        return view('home', [
            'canStart' => !$attendance,
            'canEnd' => $attendance && !$attendance->end_time && !$break,
            'canBreakStart' => $attendance && !$attendance->end_time && !$break,
            'canBreakEnd' => (bool)$break
        ]);
    }
}