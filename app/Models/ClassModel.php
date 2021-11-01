<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = "classes";

    public function studentRef()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }
}
