<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;

class classController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();
        return view('admin.class.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.class.create');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'level' => 'required',
            'class_name' => 'required',
        ]);

        try {
            $class = new ClassModel();
            $class->level = $request->level;
            $class->class_name = $request->class_name;
            $class->save();

            return redirect()->route('admin.class.index')->with('success', 'Berhasil menambahkan kelas');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Gagal menambahkan kelas');
        }
    }

    public function edit($id)
    {
        $class = ClassModel::find($id);
        if ($class) {
            return view('admin.class.edit', compact('class'));
        }

        return redirect()->back()->with('failed', 'Data kelas tidak tersedia');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'level' => 'required',
            'class_name' => 'required',
        ]);

        try {
            $class = ClassModel::find($request->class_id);
            if ($class) {
                $class->level = $request->level;
                $class->class_name = $request->class_name;
                $class->save();
            }

            return redirect()->route('admin.class.index')->with('success', 'Berhasil update data kelas');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Gagal update data kelas');
        }
    }

    public function delete(Request $request)
    {
        try {

            ClassModel::where('id', $request->id)->delete();

            return response()->json([
                "status" => 1,
                "message" => 'Data kelas berhasil dihapus',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "status" => 0,
                "message" => 'Data kelas gagal dihapus',
            ]);
        }
    }
}
