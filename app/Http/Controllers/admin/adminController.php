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
        $accounts = User::where('role', 'admin')->get();
        return view('admin.admin.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        try {

            $acccount = new User();
            $acccount->fullname = $request->fullname;
            $acccount->username = $request->username;
            $acccount->password = Hash::make($request->password);
            $acccount->email = $request->email;
            $acccount->role = "admin";
            $acccount->save();

            return redirect()->route('admin.admin.index')->with('success', 'Data admin berhasil ditambahkan');
        } catch (\Throwable $err) {
            return redirect()->route('admin.admin.index')->with('failed', 'Data admin gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $account = User::find($id);
        if ($account) {
            return view('admin.admin.edit', compact('account'));
        }
        return redirect()->back()->with('failed', 'Data admin tidak ada');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'username' => 'required',
        ]);

        try {

            $acccount = User::find($request->id);
            if ($acccount) {
                $acccount->fullname = $request->fullname;
                $acccount->email = $request->email;
                $acccount->username = $request->username;
                if ($request->password) {
                    $acccount->password = Hash::make($request->password);
                } else {
                    $acccount->password = $request->oldPassword;
                }
                $acccount->save();

                return redirect()->route('admin.admin.index')->with('success', 'Data admin berhasil diedit');
            }

            return redirect()->back()->with('failed', 'Data admin tidak ada');
        } catch (\Throwable $err) {
            return redirect()->route('admin.admin.index')->with('success', 'Data admin gagal diedit');
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
