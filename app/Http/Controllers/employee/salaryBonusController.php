<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\SalaryBonus;
use App\SalaryBonusDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class salaryBonusController extends Controller
{
    public function index()
    {
        $bonuses = SalaryBonusDetail::with('salaryBonusRef')->where('employee_id', Session::get('employee_id'))->get();

        // $bonuses = SalaryBonus::with('detailRef')->whereHas('detailRef', function ($query) {
        //     $query->where('employee_id', Session::get('employee_id'));
        // })->get();

        return view('pegawai.salarybonus.index', compact('bonuses'));
    }

    public function detail($id)
    {
        $bonus = SalaryBonus::with('detailRef', 'detailRef.employeeRef')->find($id);

        if ($bonus) {
            return view('pegawai.salarybonus.detail', compact('bonus'));
        }
    }
}
