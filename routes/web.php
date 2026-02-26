<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\DashboardController;



Route::get('/lang/{locale}', function ($locale) {

    if (!in_array($locale, ['ar', 'en'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return back();

})->name('lang.switch');


Route::redirect('/admin/login', '/login');

Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login']);

Route::post('/logout', [CustomLoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/attendance', [AttendanceController::class, 'index'])
            ->name('attendance');

        Route::post('/attendance/scan', [AttendanceController::class, 'scan'])
            ->name('attendance.scan');

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

    });


Route::middleware(['auth', 'role:course_lecturer'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get('/', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [App\Http\Controllers\Teacher\ProfileController::class, 'edit'])
            ->name('profile');

        Route::put('/profile', [App\Http\Controllers\Teacher\ProfileController::class, 'update'])
            ->name('profile.update');

    });



Route::get('/lecture-session/{session}/qr', function (App\Models\LectureSession $session) {

    $user = auth()->user();

    if (!$user || ($user->id !== $session->lecturer_id && !$user->hasRole('super_admin'))) {
        abort(403);
    }

    $token = $session->tokens()
        ->where('token_type', 'qr')
        ->where('expires_at', '>', now())
        ->first();

    return view('lecture-session.qr', compact('session', 'token'));

})->middleware('auth');

Route::get('/departments/{faculty}', function($faculty){

    return \App\Models\Department::where('faculty_id',$faculty)
        ->select('id','name')
        ->get();

});


Route::get('/', function () {

    if (auth()->check()) {

        $user = auth()->user();

        return match (true) {
            $user->hasRole('student') => redirect('/student'),
            $user->hasRole('course_lecturer') => redirect('/teacher'),
            default => redirect('/login')
        };
    }

    return redirect('/login');

});
