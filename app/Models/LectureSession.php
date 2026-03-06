<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureSession extends Model
{
    protected $fillable = [
        'subject_id',
        'lecturer_id',
        'hall_id',
        'session_date',
        'start_time',
        'end_time',
        'status',
        'attendance_mode',
        'qr_refresh_rate',
        'notes',
        'session_otp'
    ];

    public function subject()
{
    return $this->belongsTo(Subject::class);
}

public function lecturer()
{
    return $this->belongsTo(User::class, 'lecturer_id');
}

public function hall()
{
    return $this->belongsTo(Hall::class);
}

public function attendances()
{
    return $this->hasMany(Attendance::class);
}

public function tokens()
{
    return $this->hasMany(AttendanceToken::class);
}
}
