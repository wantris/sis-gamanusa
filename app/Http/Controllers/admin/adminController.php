<?php

namespace App\Http\Controllers\admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function index()
    {
        $accounts = User::with('employeeRef')->where('role', 'admin')->get();
        return view('admin.admin.index', compact('accounts'));
    }

    public function create()
    {
        $employees = Employee::get();
        return view('admin.admin.create', compact('employees'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'employee' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $em = Employee::find($request->employee);

            if ($em) {
                $acccount = new User();
                $acccount->employee_id = $request->employee;
                $acccount->username = $request->username;
                $acccount->password = Hash::make($request->password);
                $acccount->role = "admin";
                $acccount->save();

                return redirect()->route('admin.admin.index')->with('success', 'Data akun berhasil ditambahkan');
            }

            return redirect()->back()->with('failed', 'Data karyawan tidak ada');
        } catch (\Throwable $err) {
            return redirect()->route('admin.admin.index')->with('success', 'Data akun gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $employees = Employee::get();
        $account = User::find($id);
        if ($account) {
            $employees = Employee::get();
            return view('admin.admin.edit', compact('employees', 'account'));
        }
        return redirect()->back()->with('failed', 'Data admin tidak ada');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'employee' => 'required',
            'username' => 'required',
        ]);

        try {
            $em = Employee::find($request->employee);

            if ($em) {
                $acccount = User::find($request->id);
                if ($acccount) {
                    $acccount->employee_id = $request->employee;
                    $acccount->username = $request->username;
                    if ($request->password) {
                        $acccount->password = Hash::make($request->password);
                    } else {
                        $acccount->password = $request->oldPassword;
                    }
                    $acccount->save();

                    return redirect()->route('admin.admin.index')->with('success', 'Data akun berhasil diedit');
                }

                return redirect()->back()->with('failed', 'Data admin tidak ada');
            }

            return redirect()->back()->with('failed', 'Data karyawan tidak ada');
        } catch (\Throwable $err) {
            return redirect()->route('admin.admin.index')->with('success', 'Data akun gagal diedit');
        }
    }

    public function delete(Request $request)
    {
        try {

            User::where('id', $request->id)->delete();

            return response()->json([
                "status" => 1,
                "message" => 'Data admin berhasil dihapus',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "status" => 0,
                "message" => 'Data admin gagal dihapus',
            ]);
        }
    }
}
