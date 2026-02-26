<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomLoginController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string|unique:users,student_number',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'faculty_id' => 'required|exists:faculties,id',
            'department_id' => 'required|exists:departments,id',
            'year' => 'required|integer|min:1|max:4',
            'password' => 'required|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048'
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')
                ->store('avatars', 'public');
        }

        $user = User::create([
            'student_number' => $request->student_number,
            'name' => $request->name,
            'email' => $request->email,
            'faculty_id' => $request->faculty_id,
            'department_id' => $request->department_id,
            'year' => $request->year,
            'avatar' => $avatarPath,
            'password' => Hash::make($request->password),
            'status' => 'active',
            'type' => 'student'
        ]);

        $user->assignRole('student');

        auth()->login($user);

        return redirect('/student')
            ->with('success', __('auth.register_success'));
    }



    public function showRegister()
    {
        $faculties = Faculty::with('departments')->get();

        return view('auth.register', compact('faculties'));
    }

    public function showLoginForm()
    {
        return view('auth.custom-login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'nullable|in:student,lecturer,admin',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'بيانات الدخول غير صحيحة.',
            ]);
        }

        $user = Auth::user();

        if (!$user->is_active ?? true) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'الحساب غير مفعل.',
            ]);
        }

        if ($request->filled('role')) {

            $map = [
                'student' => 'student',
                'lecturer' => 'course_lecturer',
                'admin' => 'super_admin',
            ];

            $spatieRole = $map[$request->role] ?? null;

            if ($spatieRole && !$user->hasRole($spatieRole)) {
                Auth::logout();

                return back()->withErrors([
                    'role' => 'ليس لديك هذه الصلاحية.',
                ]);
            }
        }
        $request->session()->regenerate();

        return match(true) {

            $user->hasRole('student') => redirect('/student'),

            $user->hasRole('course_lecturer') => redirect('/teacher'),

            $user->hasRole('super_admin') => redirect('/admin'),

            default => redirect('/login')

        };

    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
