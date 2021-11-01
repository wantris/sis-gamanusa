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
                    Session::put('is_student', '0');
                    Session::put('user_id', $check_username->id);

                    return redirect()->route('admin.home.index');
                } else {
                    Session::put('is_admin', '0');
                    Session::put('is_student', '1');
                    Session::put('id', $check_username->id);
                    Session::put('user_id', $check_username->id);
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
        return redirect('/admin');
    }

    public function profile()
    {
        $user = User::find(Session::get('user_id'));
        if ($user) {
            return view('auth.profile', compact('user'));
        }
    }

    public function postProfile(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email' => 'required',
        ]);

        try {
            $namephoto = $request->oldPhoto;

            if ($request->file('photo')) {
                $resorcephoto = $request->file('photo');
                $namephoto   = "photo_" . rand(0000, 9999) . "." . $resorcephoto->getClientOriginalExtension();
                $resorcephoto->move(\base_path() . "/public/assets/img/user-photo/", $namephoto);
            }

            $user = User::find(Session::get('user_id'));
            $user->email = $request->email;
            $user->fullname = $request->fullname;
            $user->photo = $namephoto;
            $user->save();

            return redirect()->back()->with('success', 'Berhasil update profil');


            return redirect()->back()->with('failed', 'Gagal update profil');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('failed', 'Terjadi kesalahan silahkanhubungi yang bersangkutan');
        }
    }

    public function changePassword()
    {
        return view('auth.change_password');
    }

    public function postChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $user = User::find(Session::get('user_id'));

        if (!Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Update password berhasil');
        }

        return redirect()->back()->with('failed', 'Password tidak boleh sama dengan sebelumnya');
    }
}
