<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.custom-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'nullable|in:student,lecturer,admin',  
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

             if ($request->filled('role')) {
                $role = $request->role;
                 $spatieRole = match($role) {
                    'student' => 'student',
                    'lecturer' => 'course_lecturer',
                    'admin' => 'super_admin', 
                    default => null,
                };
                
                if (!$user->hasRole($spatieRole)) {
                    Auth::logout();
                    return back()->withErrors([
                        'role' => 'ليس لديك الصلاحية للدخول بهذه الصفة.',
                    ]);
                }
            }

           
            if (  $user->hasRole('student')) {
                return redirect()->intended('/student');  
            } else {
                return redirect()->intended('/admin'); 
            }
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ]);
    }
}