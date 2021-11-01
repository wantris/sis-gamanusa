<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function studentClassRef()
    {
        return $this->hasMany(StudentClass::class, 'student_id', 'id');
    }

    public function lastStudentClassRef()
    {
        return $this->hasOne(StudentClass::class, 'student_id', 'id')->latest();
    }
}
