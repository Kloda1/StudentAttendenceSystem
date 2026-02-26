<?php
//
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Lecture\LectureSessionController;
//

//
//Route::middleware(['auth'])
//    ->prefix('lecture')
//    ->name('lecture.')
//    ->group(function(){
//
//        Route::get('/{session}/qr',
//            [LectureSessionController::class,'generateQR']
//        )->name('qr');
//
//        Route::post('/{session}/start',
//            [LectureSessionController::class,'startSession']
//        )->name('start');
//
//        Route::post('/{session}/end',
//            [LectureSessionController::class,'endSession']
//        )->name('end');
//
//        Route::post('/{session}/cancel',
//            [LectureSessionController::class,'cancelSession']
//        )->name('cancel');
//
//    });
