<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailRegister;
use App\Models\Npsn;
use App\Models\Student;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public function index()
    {
        return view('student.auth.login');
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
                $student = Student::where('user_id', $check_username->id)->first();
                Session::put('is_admin', '0');
                Session::put('is_student', '1');
                Session::put('student_id', $student->id);
                Session::put('user_id', $check_username->id);
                return redirect()->route('siswa.home.index');
            } else {
                return redirect()->back()->with('failed', 'Password salah');
            }
        } else {
            return redirect()->back()->with('failed', 'Username tidak ada');
        }
    }

    public function register()
    {
        return view('student.auth.register');
    }

    public function postRegister(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email' => 'required|unique:students,email',
            'phone' => 'required',
            'address' => 'required',
            'place' => 'required',
            'date' => 'required',
            'gender' => 'required',
        ]);

        try {

            $npsnNumber = "";
            $id = "";

            $student = Student::latest()->first();

            if ($student) {
                $id = (int)$student->nis + 1;
                $id = substr($id, -3);
            } else {
                $id = "001";
            }

            $npsn = Npsn::latest()->first();
            if ($npsn) {
                $npsnNumber = substr($npsn->number, -5);
                $CurrentYear = substr(Carbon::now()->format('Y'), -2);
                $nis = $CurrentYear . $npsnNumber . $id;

                $user = new User();
                $user->fullname = $request->fullname;
                $user->username = $nis;
                $user->password = Hash::make("@Gamanusa123");
                $user->email = $request->email;
                $user->role = "student";
                $user->save();

                $siswa = new Student();
                $siswa->fullname = $request->fullname;
                $siswa->user_id = $user->id;
                $siswa->nis = $nis;
                $siswa->email = $request->email;
                $siswa->phone = $request->phone;
                $siswa->date_of_birth = $request->date;
                $siswa->place_of_birth = $request->place;
                $siswa->gender = $request->gender;
                $siswa->address = $request->address;
                $siswa->save();

                $this->sendEmail($siswa);

                return redirect()->route('siswa.auth.register.success');
            }

            return redirect()->back()->with('failed', 'Terjadi kesalahan silahkanhubungi yang bersangkutan');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('failed', 'Terjadi kesalahan silahkanhubungi yang bersangkutan');
        }
    }

    public function registerSuccess()
    {
        return view('student.auth.success_register');
    }

    public function sendEmail($student)
    {
        Mail::to($student->email)->send(new SendEmailRegister($student));
    }

    public function profile()
    {
        $user = User::with('studentRef')->find(Session::get('user_id'));
        if ($user) {
            return view('student.auth.profile', compact('user'));
        }
    }

    public function postProfile(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'place' => 'required',
            'date' => 'required',
            'gender' => 'required',
        ]);

        try {

            $siswa = Student::find(Session::get('student_id'));
            $namephoto = $request->oldPhoto;

            if ($siswa) {
                $siswa->fullname = $request->fullname;
                $siswa->nis = $request->nis;
                $siswa->email = $request->email;
                $siswa->phone = $request->phone;
                $siswa->date_of_birth = $request->date;
                $siswa->place_of_birth = $request->place;
                $siswa->gender = $request->gender;
                $siswa->address = $request->address;
                $siswa->save();



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
            }

            return redirect()->back()->with('failed', 'Gagal update profil');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('failed', 'Terjadi kesalahan silahkanhubungi yang bersangkutan');
        }
    }

    public function changePassword(Request $request)
    {
        return view('student.auth.change_password');
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

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/siswa');
    }
}
