<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
//    public function handle(Request $request, Closure $next)
//     {
//         if (!Auth::check()) 
//             {
//                 return redirect()->route('login');
//             }
        
//             if(Auth::user()->role == 'admin')
//             {
//                 return $next($request);

//             }
//             else
//             {
//                 return redirect()->route('admin.home');
//             }
//     }

public function handle(Request $request, Closure $next)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    // فقط السماح بالمرور اذا مسجل دخول (مش شرط دور الادمن هنا)
    return $next($request);
}


}
