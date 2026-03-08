<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{


    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'enrollments', 'student_id', 'subject_id')
            ->withPivot(['semester', 'year', 'status'])
            ->withTimestamps();
    }
}
