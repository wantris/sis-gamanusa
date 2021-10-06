<?php

namespace App\Http\Controllers\admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\SalaryBonus;
use App\User;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->get()->count();
        $employee = Employee::get()->count();
        $user = User::get()->count();
        $bonus = SalaryBonus::get()->count();

        return view('admin.home', compact(
            'admin',
            'employee',
            'user',
            'bonus'
        ));
    }
}
