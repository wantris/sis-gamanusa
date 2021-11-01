<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function index()
    {
        $class = StudentClass::where('student_id', Session::get('student_id'))->get()->count();

        return view('student.home', compact('class'));
    }
}
