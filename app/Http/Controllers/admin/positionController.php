<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;

class positionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('admin.position.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.position.create');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'salary' => 'required',
        ]);

        try {
            $ps = new Position();
            $ps->position_cd = $request->code;
            $ps->position_name = $request->name;
            $ps->salary = $request->salary;
            $ps->save();

            return redirect()->route('admin.position.index')->with('success', 'Jabatan berhasil ditambahkan');
        } catch (\Throwable $err) {
            return redirect()->route('admin.position.index')->with('failed', 'Jabatan gagal ditambahkan');
        }
    }

    public function edit($code)
    {
        $ps = Position::where('position_cd', $code)->first();
        if ($ps) {
            return view('admin.position.edit', compact('ps'));
        }

        return redirect()->back()->with('failed', 'Data jabatan tidak ada');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'salary' => 'required',
        ]);

        try {
            $ps = Position::where('position_cd', $request->code)->first();

            if ($ps) {
                $ps->position_cd = $request->code;
                $ps->position_name = $request->name;
                $ps->salary = $request->salary;
                $ps->save();
                return redirect()->route('admin.position.index')->with('success', 'Jabatan berhasil diupdate');
            }

            return redirect()->back()->with('failed', 'Data jabatan tidak ada');
        } catch (\Throwable $err) {
            dd($err);
            return redirect()->route('admin.position.index')->with('failed', 'Jabatan gagal diupdate');
        }
    }

    public function delete(Request $request)
    {
        try {

            $ps = Position::where('position_cd', $request->code)->delete();

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
}
