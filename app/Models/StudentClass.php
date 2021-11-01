<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    public function classRef()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}
