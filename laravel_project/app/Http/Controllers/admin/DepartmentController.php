<?php

namespace App\Http\Controllers\admin;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Middleware\NoCache;
use App\Http\Kernel;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
     public function index_depart()
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $departments = Department::get();
        return view('admin.departments.index_depart',compact('departments'));
        
    }
    public function add_depart()
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        // $departments= Department::get();
        return view('admin.departments.add_depart');
    }


    public function store_depart(DepartmentRequest $request)
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }
        $data = $request->validated();

        if($request->hasFile('photo'))
        {
            $photoName = $request->file('photo')->getClientOriginalName();
            $photo = $request->file('photo')->storeAs('images',$photoName);
            $data['photo'] = $photo;
        }
            


            
        
            
        Department::create($data);

        return redirect()->back()->with('msg','department added successfully :)');
    }


  
    
    public function destroy_depart($id)
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $department = Department::findorfail($id);

        $department -> delete();
        return redirect()->back()->with('msg','department deleted successfully :)');
    }

    public function edit_depart($id)
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $departments= Department::get();
        $department = Department::findorfail($id);

        return view('admin.departments.edit_depart',compact('departments','department'));
        
    }

    public function update_depart(DepartmentRequest $request,$id)
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $data =$request->validated();


        if($request->hasFile('photo'))
        {
            $photoName = $request->file('photo')->getClientOriginalName();
            $photo = $request->file('photo')->storeAs('images',$photoName);
            $data['photo'] = $photo;
        }
            
        
        $department = Department::findorfail($id);
        $department->update($data);

        return redirect()->back()->with('msg','department updated successfully :)');

    }

public function subscribe(Request $request, Department $department)
{
     if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();
    // $user = Auth::user();

    // جرب تجيب الطالب حسب الإيميل
    $student = Student::where('email', $user->email)->first();

    if ($student) {
        if ($student->department_id && $student->department_id != $department->id) {
            // لو عنده قسم مختلف
            return redirect()->back()->with('warning', 'You already have a department assigned. Are you sure you want to change it?')->with('department_id', $department->id);
        } elseif ($student->department_id == $department->id) {
            // لو مشترك في نفس القسم
            return redirect()->back()->with('msg', 'You are already subscribed to this department!');
        } else {
            // لم يكن لديه قسم مسجل
            $student->department_id = $department->id;
            $student->save();

             $departmentName = $department->name;
            return redirect()->back()->with('msg', 'Subscribed to department successfully :) '. $departmentName);
        }
    } else {
        // لو الطالب غير موجود في جدول الطلاب - انشئ له سجل جديد
        Student::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? null,
            'photo' => $user->photo ?? null,
            'department_id' => $department->id,
        ]);
        $departmentName = $department->name;

        return redirect()->back()->with('msg', 'Subscribed successfully and student profile created :)  '. $departmentName);
    }
}



public function changeDepartment(Request $request, Department $department)
{
    $user = Auth::user();

    // جلب بيانات الطالب حسب إيميل اليوزر
    $student = \App\Models\Student::where('email', $user->email)->first();

    if ($student) {
        // تحديث قسم الطالب في جدول الطلاب
        $student->department_id = $department->id;
        $student->save();
    } else {
        // إضافة سجل جديد للطالب مع بياناته وقسمه
        \App\Models\Student::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? null,
            'photo' => $user->photo ?? null,
            'department_id' => $department->id,
        ]);
    }
    $departmentName = $department->name;
    
    return redirect()->back()->with('msg', 'department changed successfully:) ' . $departmentName);

}

public function cancelChange()
{
    return redirect()->back()->with('msg', 'cancel changes');
}


}
