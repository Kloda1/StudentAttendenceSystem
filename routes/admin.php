<?php


use Illuminate\Support\Facades\Route;



//Route::middleware([
//    'auth',
//    'role:super_admin|attendance_monitor'
//])
//    ->prefix('admin')
//    ->name('admin.')
//    ->group(function () {
//
//        /*
//        | Users Management
//        */
//
//        Route::resource('users',
//            App\Http\Controllers\Admin\UserController::class
//        );
//
//        /*
//        | Roles & Permissions
//        */
//
//        Route::resource('roles',
//            App\Http\Controllers\Admin\RoleController::class
//        );
//
//        Route::resource('permissions',
//            App\Http\Controllers\Admin\PermissionController::class
//        );
//
//        /*
//        | System Modules
//        */
//
//        Route::resource('halls',
//            App\Http\Controllers\Admin\HallController::class
//        );
//
//        Route::resource('departments',
//            App\Http\Controllers\Admin\DepartmentController::class
//        );
//
//        Route::resource('subjects',
//            App\Http\Controllers\Admin\SubjectController::class
//        );
//
//        Route::get('/reports',
//            App\Http\Controllers\Admin\ReportController::class
//        )->name('reports');
//
//    });
