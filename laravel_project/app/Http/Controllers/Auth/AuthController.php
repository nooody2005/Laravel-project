<?php



namespace App\Http\Controllers\Auth;
use App\Models\Student;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Middleware\NoCache;
use App\Http\Kernel;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function handleLogin(Request $request)
    {
        $data =$request->validate([
        'email' =>'required|email',
        'password' =>'required|min:6',
       ]);

       $is_login =Auth::attempt(['email' => $request->email, 'password' => $request->password]);

       if(!$is_login )
       {
            return redirect()->route('login')->with('msg','not valid email or password');
       }
       if(Auth::user()->role == 'user')
        {
            return redirect()->route('admin.home');
        }
       else
        {
            return redirect()->route('admin.students.index');

        }

    }

    public function login()
    {
        return view('auth.login');

    }

    public function handleRegister(Request $request)
    {
       $data =$request->validate([
        'name' => 'required',
        'email' =>'required|email',
        'password' =>'required|min:6',
       ]);

       $data['password'] = Hash::make($request->password);
       $user = User::create($data);

       Auth::login($user);
       return redirect()->route('admin.home');
       

    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        // return redirect()->route('login');
        return redirect('/login');
    }
}
