<?php

namespace App\Http\Controllers\admin;
use App\Models\Department;
use App\Http\Controllers\admin\DepartmentController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
   

public function __invoke()
{
    $departments = Department::all();

    // جلب بيانات الطالب بناءً على المستخدم المسجل دخول
    $student = null;
    if (Auth::check()) {
        $userEmail = Auth::user()->email;
        $student = Student::where('email', $userEmail)->first();
    }

    return view('admin.home', compact('departments', 'student'));
}


    
}

