<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class classController extends Controller
{
    public function index()
    {
        $listClass = StudentClass::with('classRef')->where('student_id', Session::get('student_id'))->get();

        return view('student.class.index', compact('listClass'));
    }
}
