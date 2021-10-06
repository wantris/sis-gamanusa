<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;

        $check_username = User::where('username', $username)->first();
        // check username
        if ($check_username) {
            if (Hash::check($password, $check_username->password)) {

                if ($check_username->role == "admin") {
                    Session::put('is_admin', '1');
                    Session::put('is_reguler', '0');
                    Session::put('id', $check_username->id);
                    Session::put('employee_id', $check_username->employee_id);
                    return redirect()->route('admin.home.index');
                } else {
                    Session::put('is_admin', '0');
                    Session::put('is_reguler', '1');
                    Session::put('id', $check_username->id);
                    Session::put('employee_id', $check_username->employee_id);
                    return redirect()->route('employee.home.index');
                }
            } else {
                return redirect()->back()->with('failed', 'Password salah');
            }
        } else {
            return redirect()->back()->with('failed', 'Username tidak ada');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
