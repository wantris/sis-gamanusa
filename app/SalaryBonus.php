<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryBonus extends Model
{
    public function detailRef()
    {
        return $this->hasMany(SalaryBonusDetail::class, 'salary_bonus_id', 'id');
    }
}
