<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\ProfileController;


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
            ->name('profile.edit');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

    });
