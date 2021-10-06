<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryBonusDetail extends Model
{
    public function salaryBonusRef()
    {
        return $this->belongsTo(SalaryBonus::class,  'salary_bonus_id', 'id');
    }
    public function employeeRef()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
