<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Npsn;
use Illuminate\Http\Request;

class npsnController extends Controller
{
    public function index()
    {
        $npsns = Npsn::all();
        return view('admin.npsn.index', compact('npsns'));
    }

    public function create()
    {
        return view('admin.npsn.create');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required',
            'date' => 'required',
        ]);

        try {
            $npsn = new Npsn();
            $npsn->number = $request->number;
            $npsn->date = $request->date;
            $npsn->save();

            return redirect()->route('admin.npsn.index')->with('success', 'Data NPSN berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Data NPSN gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $npsn = Npsn::find($id);
        if ($npsn) {
            return view('admin.npsn.edit', compact('npsn'));
        }

        return redirect()->route('admin.npsn.index')->with('failed', 'Data NPSN tidak tersedia');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required',
            'date' => 'required',
        ]);

        try {
            $npsn = Npsn::find($request->id);
            if ($npsn) {
                $npsn->number = $request->number;
                $npsn->date = $request->date;
                $npsn->save();
                return redirect()->route('admin.npsn.index')->with('success', 'Data NPSN berhasil ditambahkan');
            }

            return redirect()->route('admin.npsn.index')->with('failed', 'Data NPSN tidak tersedia');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Data NPSN gagal ditambahkan');
        }
    }

    public function delete(Request $request)
    {
        try {

            Npsn::where('id', $request->id)->delete();

            return response()->json([
                "status" => 1,
                "message" => 'Data NPSN berhasil dihapus',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "status" => 0,
                "message" => 'Data NPSN gagal dihapus',
            ]);
        }
    }
}
