<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\DashboardController;
use App\Models\LectureSession;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


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
    // ->middleware('auth')
    ->name('logout');




Route::get('/attendance', [AttendanceController::class, 'index'])

    ->name('student.attendance');

Route::post(
    '/student/attendance/scan/{session}',
    [AttendanceController::class, 'scan'])  ->name('student.attendance.scan');

//Route::get('/student/attendance/verify-otp/{session}', function ($session) {
Route::get('/student/attendance/{session}', function ($session) {

    session(['verify_session' => $session]);
    return view('student.attendance');
    // return view('student.attendance.verify-otp');

})->name('student.attendance.verify.form');


Route::get(
    '/lecture-session/{session}/qr',
    [AttendanceController::class, 'showQr']
)
// ->middleware([  'throttle:30,1'])
    ->name('teacher.lecture-session.qr');



    Route::prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/attendance/{session}', function ($session) {

            return view('student.attendance.verify-otp', [
                'sessionId' => $session
            ]);

        })->name('attendance.verify.form');

        Route::post(
            '/attendance/store/{session}',
            [AttendanceController::class, 'store']
        )->name('attendance.store');

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



Route::get('/departments/{faculty}', function ($faculty) {

    return \App\Models\Department::where('faculty_id', $faculty)
        ->select('id', 'name')
        ->get();
});


Route::get('/', function () {

    if (auth()->check()) {

        $user = auth()->user();

        return match (true) {
            $user->hasRole('super-admin') => redirect('/super-admin'),
            $user->hasRole('course_lecturer') => redirect('/teacher'),
            $user->hasRole('manager') => redirect('/manager'),
            default => redirect('/login')
        };
    }

    return redirect('/login');
});
