<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailRegister;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Npsn;
use App\Models\StudentClass;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class studentController extends Controller
{
    public function index()
    {
        $students = Student::with('lastStudentClassRef.classRef')->get();
        return view('admin.student.index', compact('students'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function save(Request $request)
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

                return redirect()->route('admin.student.index');
            }

            return redirect()->back()->with('failed', 'Terjadi kesalahan silahkanhubungi yang bersangkutan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan silahkanhubungi yang bersangkutan');
        }
    }

    public function edit($id)
    {
        $st = Student::find($id);
        if ($st) {

            return view('admin.student.edit', compact('st'));
        }

        return redirect()->route('admin.student.index')->with('failed', 'Data siswa tidak tersedia');
    }

    public function update(Request $request)
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

            $siswa = Student::find($request->id);
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
            }


            return redirect()->route('admin.student.index')->with('success', 'Data siswa berhasil diedit');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('failed', 'Terjadi kesalahan silahkanhubungi yang bersangkutan');
        }
    }

    public function delete(Request $request)
    {
        try {

            $student = Student::find($request->id);
            if ($student) {
                User::where('username', $student->nis)->delete();
            }

            return response()->json([
                "status" => 1,
                "message" => 'Data siswa berhasil dihapus',
            ]);
        } catch (\Throwable $err) {
            return response()->json([
                "status" => 0,
                "message" => 'Data siswa gagal dihapus',
            ]);
        }
    }

    public function detail($id)
    {
        $st = Student::with('studentClassRef.classRef')->find($id);
        $listClass = ClassModel::all();

        if ($st) {
            return view('admin.student.detail', compact('st', 'listClass'));
        }

        return redirect()->route('admin.student.index')->with('failed', 'Data siswa tidak tersedia');
    }

    public function createClass(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'student_id' => 'required',
            'year' => 'required'
        ]);

        try {
            $class = new StudentClass();
            $class->student_id = $request->student_id;
            $class->class_id = $request->class_id;
            $class->year = $request->year;
            $class->save();

            return redirect()->back()->with('success', 'Tambah riwayat kelas berhasil');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('failed', 'Tambah riwayat kelas gagal');
        }
    }

    public function sendEmail($student)
    {
        Mail::to($student->email)->send(new SendEmailRegister($student));
    }
}
