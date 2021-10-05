<?php

namespace App\Http\Controllers\admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        $ps = Position::all();
        return view('admin.employee.create', compact('ps'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'employee_name' => 'required',
            'position' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'email' => 'required',
        ]);

        try {

            $em = new Employee();
            $em->position_cd = $request->position;
            $em->name = $request->employee_name;
            $em->nik = $request->nik;
            $em->gender = $request->gender;
            $em->email = $request->email;
            $em->save();

            return redirect()->route('admin.employee.index')->with('success', 'Data karyawan berhasil ditambahkan');
        } catch (\Throwable $err) {
            return redirect()->route('admin.employee.index')->with('failed', 'Data karyawan gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $em = Employee::find($id);
        if ($em) {
            $ps = Position::all();
            return view('admin.employee.edit', compact('em', 'ps'));
        }

        return redirect()->back()->with('failed', 'Data karyawan tidak ada');
    }

    public function update(Request $request)
    {
        $em = Employee::find($request->id);
        if ($em) {
            $validatedData = $request->validate([
                'employee_name' => 'required',
                'position' => 'required',
                'nik' => 'required',
                'gender' => 'required',
                'email' => 'required',
            ]);

            try {
                $em->position_cd = $request->position;
                $em->name = $request->employee_name;
                $em->nik = $request->nik;
                $em->gender = $request->gender;
                $em->email = $request->email;
                $em->save();
                return redirect()->route('admin.employee.index')->with('success', 'Data karyawan berhasil diupdate');
            } catch (\Throwable $err) {
                return redirect()->route('admin.employee.index')->with('failed', 'Data karyawan gagal ditambahkan');
            }
        }

        return redirect()->back()->with('failed', 'Data karyawan tidak ada');
    }

    public function delete(Request $request)
    {
        try {

            Employee::where('id', $request->id)->delete();

            return response()->json([
                "status" => 1,
                "message" => 'Data Jabatan berhasil dihapus',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "status" => 0,
                "message" => 'Data Jabatan gagal dihapus',
            ]);
        }
    }


    public function getEmployeeJson()
    {
        try {
            $employees = Employee::all();

            return response()->json([
                'code' => 200,
                'datas' => $employees,
                'message' => 'Get employees success',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                'code' => 500,
                'datas' => null,
                'message' => 'Get employees failed',
            ]);
        }
    }
}
