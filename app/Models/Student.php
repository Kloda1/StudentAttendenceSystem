<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function enrollments()
{
    return $this->hasMany(Enrollment::class, 'student_id');
}
 
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'enrollments', 'student_id', 'subject_id')
            ->withPivot(['semester', 'year', 'status'])
            ->withTimestamps();
    }
}
