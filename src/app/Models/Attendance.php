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
        'end_time'
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

    public function breaks()
    {
        return $this->hasMany(Breaktime::class);
    }

    public function breaktimes()
    {
        return $this->hasMany(Breaktime::class);
    }

    public function getTotalBreakTimeAttribute()
    {
        $total = 0;
        // $this->breaks を $this->breaktimes に修正
        foreach ($this->breaktimes as $break) {
            if ($break->end_time) {
                $total += $break->end_time->diffInMinutes($break->start_time);
            }
        }
        return sprintf('%02d:%02d', floor($total / 60), $total % 60);
    }

    public function getWorkTimeAttribute()
    {
        if (!$this->end_time) {
            return '-';
        }

        $totalMinutes = $this->end_time->diffInMinutes($this->start_time);
        $breakMinutes = 0;

        // $this->breaks を $this->breaktimes に修正
        foreach ($this->breaktimes as $break) {
            if ($break->end_time) {
                $breakMinutes += $break->end_time->diffInMinutes($break->start_time);
            }
        }

        $workMinutes = $totalMinutes - $breakMinutes;
        return sprintf('%02d:%02d', floor($workMinutes / 60), $workMinutes % 60);
    }
}