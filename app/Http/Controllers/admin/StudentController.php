<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Middleware\NoCache;
use App\Http\Kernel;

use App\Http\Controllers\admin\DepartmentController;
use App\Models\Student;
use App\Models\Department;

use App\Http\Controllers\Controller;

use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;

use App\Middleware\IsLogin;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    public function index()
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        // $students = Student::get();
        $students = DB::table('students')
        ->leftJoin('departments', 'students.department_id', '=', 'departments.id')
        ->select('students.*', 'departments.name as department_name')
        ->get();

        return view('admin.students.index',compact('students'));
        
    }
    public function create()
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $departments= Department::get();
        return view('admin.students.create',compact('departments'));
    }

    public function show($id)
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $student = Student::findorfail($id);

        $student = DB::table('students')
        ->leftJoin('departments', 'students.department_id', '=', 'departments.id')
        ->select('students.*', 'departments.name as department_name')
        ->where('students.id', $id)
        ->first();
        
        return view('admin.students.show',compact('student'));
        // return Student::findorfail($id);
        
    }

    public function store(StudentRequest $request)
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
            
        Student::create($data);

        return redirect()->back()->with('msg','added successfully :)');
    }


  
    
    public function destroy($id)
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $student = Student::findorfail($id);

        if(!empty($student->photo) && Storage::exists($student->photo))
        {
            Storage::delete($student->photo);
            if(empty(Storage::files('images')))
            {
                Storage::deleteDirectory('images');
            }
        }



        $student -> delete();
        return redirect()->back()->with('msg','deleted successfully :)');
    }

    public function edit($id)
    {
        if(Auth::user()->role != 'admin') 
        {
        return redirect()->route('admin.home')->with('error', 'Access denied');
        }

        $departments= Department::get();
        $student = Student::findorfail($id);

        return view('admin.students.edit',compact('departments','student'));
        
    }

    public function update(StudentRequest $request,$id)
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
       
        $student = Student::findorfail($id);
        $student->update($data);

        return redirect()->back()->with('msg','updated successfully :)');

    }
}

