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
        $user = User::get()->count();

        return view('admin.home', compact(
            'admin',
            'user'
        ));
    }
}
