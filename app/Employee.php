<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function positionRef()
    {
        return $this->hasOne(Position::class, 'position_cd', 'position_cd');
    }
}
