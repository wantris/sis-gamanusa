<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\SalaryBonusDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function index()
    {
        $bonuses = SalaryBonusDetail::with('salaryBonusRef')->where('employee_id', Session::get('employee_id'))->get()->count();

        return view('pegawai.home', compact('bonuses'));
    }
}
