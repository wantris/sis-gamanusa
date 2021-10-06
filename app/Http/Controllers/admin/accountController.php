<?php

namespace App\Http\Controllers\admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class accountController extends Controller
{
    public function index()
    {
        $accounts = User::all();
        return view('admin.account.index', compact('accounts'));
    }

    public function create()
    {
        $employees = Employee::get();
        return view('admin.account.create', compact('employees'));
    }

    public function save(Request $request)
    {
        try {
            $em = Employee::find($request->employee);

            if ($em) {
                $acccount = new User();
                $acccount->employee_id = $request->employee;
                $acccount->username = $em->nik;
                $acccount->password = Hash::make('Karyawan004');
                $acccount->role = "reguler";
                $acccount->save();

                return redirect()->route('admin.account.index')->with('success', 'Data akun berhasil ditambahkan');
            }

            return redirect()->back()->with('failed', 'Data karyawan tidak ada');
        } catch (\Throwable $err) {
            return redirect()->route('admin.account.index')->with('failed', 'Data akun berhasil ditambahkan');
        }
    }
}
