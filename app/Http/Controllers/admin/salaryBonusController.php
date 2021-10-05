<?php

namespace App\Http\Controllers\admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\SalaryBonus;
use App\SalaryBonusDetail;
use Illuminate\Http\Request;

class salaryBonusController extends Controller
{
    public function index()
    {
        $bonuses = SalaryBonus::all();
        return view('admin.salarybonus.index', compact('bonuses'));
    }

    public function create()
    {
        $total_employee = Employee::get()->count();
        return view('admin.salarybonus.create', compact('total_employee'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'total_nominal' => 'required',
            'description' => 'required',
        ]);

        try {
            $bonus = new SalaryBonus();
            $bonus->title = $request->title;
            $bonus->description = $request->description;
            $bonus->nominal = $request->total_nominal;
            $bonus->save();

            if ($bonus) {
                if ($request->employee) {
                    foreach ($request->employee as $key => $item) {
                        $detail = new SalaryBonusDetail();
                        $detail->salary_bonus_id = $bonus->id;
                        $detail->employee_id = $item;
                        $detail->precentage = $request->precentage[$key];
                        $detail->nominal_total = (int)$request->precentage[$key] / 100 * $bonus->nominal;
                        $detail->save();
                    }
                }

                return redirect()->route('admin.salaryBonus.index')->with('success', 'Data bonus gaji berhasil ditambahkan');
            }
        } catch (\Throwable $err) {
            dd($err);
        }
    }

    public function edit($id)
    {
        $bonus = SalaryBonus::with('detailRef')->find($id);
        if ($bonus) {
            $total_employee = Employee::get()->count();
            $employees = Employee::get();

            return view('admin.salarybonus.edit', compact('total_employee', 'bonus', 'employees'));
        } else {
            return redirect()->route('admin.salaryBonus.index')->with('success', 'Data bonus gaji tidak ada');
        }
    }

    public function detail($id)
    {
        $bonus = SalaryBonus::with('detailRef', 'detailRef.employeeRef')->find($id);

        if ($bonus) {
            return view('admin.salarybonus.detail', compact('bonus'));
        }
    }

    public function delete(Request $request)
    {
        try {

            SalaryBonus::where('id', $request->id)->delete();

            return response()->json([
                "status" => 1,
                "message" => 'Data bonus gaji berhasil dihapus',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "status" => 0,
                "message" => 'Data bonus gaji gagal dihapus',
            ]);
        }
    }

    public function deleteDetail(Request $request)
    {
        try {

            SalaryBonusDetail::where('id', $request->id)->delete();

            return response()->json([
                "status" => 1,
                "message" => 'Data detail bonus gaji berhasil dihapus',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "status" => 0,
                "message" => 'Data detail bonus gaji gagal dihapus',
            ]);
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'total_nominal' => 'required',
            'description' => 'required',
        ]);

        try {
            $bonus = SalaryBonus::find($request->bonus_id);

            if (!$bonus) {
                return redirect()->route('admin.salaryBonus.index')->with('success', 'Data bonus gaji tidak ada');
            }

            $bonus->title = $request->title;
            $bonus->description = $request->description;
            $bonus->nominal = $request->total_nominal;
            $bonus->save();

            if ($bonus) {
                if ($request->employee) {
                    foreach ($request->employee as $key => $item) {
                        if ($request->detail_id[$key] != "null") {
                            $detail = SalaryBonusDetail::find($request->detail_id[$key]);
                            if ($detail) {
                                $detail->salary_bonus_id = $bonus->id;
                                $detail->employee_id = $item;
                                $detail->precentage = $request->precentage[$key];
                                $detail->nominal_total = (int)$request->precentage[$key] / 100 * $bonus->nominal;
                                $detail->save();
                            }
                        } else {
                            $detail = new SalaryBonusDetail();
                            $detail->salary_bonus_id = $bonus->id;
                            $detail->employee_id = $item;
                            $detail->precentage = $request->precentage[$key];
                            $detail->nominal_total = (int)$request->precentage[$key] / 100 * $bonus->nominal;
                            $detail->save();
                        }
                    }
                }

                return redirect()->route('admin.salaryBonus.index')->with('success', 'Data bonus gaji berhasil ditambahkan');
            }
        } catch (\Throwable $err) {
            dd($err);
        }
    }
}
