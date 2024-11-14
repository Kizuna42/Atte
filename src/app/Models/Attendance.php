<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'start_time',
        'end_time',
        'break_time'
    ];

    protected $dates = [
        'work_date',
        'start_time',
        'end_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breaktimes()
    {
        return $this->hasMany(Breaktime::class);
    }

    public function getTotalBreakTimeAttribute()
    {
        $totalSeconds = 0;
        foreach ($this->breaktimes as $break) {
            if ($break->end_time) {
                $totalSeconds += $break->end_time->diffInSeconds($break->start_time);
            }
        }

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function getWorkTimeAttribute()
    {
        if (!$this->end_time) {
            return '-';
        }

        $totalSeconds = $this->end_time->diffInSeconds($this->start_time);
        $breakSeconds = 0;

        foreach ($this->breaktimes as $break) {
            if ($break->end_time) {
                $breakSeconds += $break->end_time->diffInSeconds($break->start_time);
            }
        }

        $workSeconds = $totalSeconds - $breakSeconds;
        $hours = floor($workSeconds / 3600);
        $minutes = floor(($workSeconds % 3600) / 60);
        $seconds = $workSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}