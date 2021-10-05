<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryBonusDetail extends Model
{
    public function employeeRef()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
