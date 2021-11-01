<?php
    namespace App\Http\Controllers\Student;
    use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;
    
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('profile', [UserController::class,'index'])->name('profile');
    Route::get('payment',[UserController::class,'payment'])->name('payment');
    //razorpay
    Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('razorpaypayment');
    Route::post('certificate-upload/',[UserController::class,'certificate_upload'])->name('certificate_upload');
    Route::post('update-profile', [UserController::class,'updateProfile'])->name('updateProfile');
    Route::group(['middleware' => ['payment.confirm']], function (){       
        
        Route::get('change-password', [UserController::class,'changePassword'])->name('changePassword');
        Route::post('update-password', [UserController::class,'updatePassword'])->name('updatePassword');
    
        Route::any('attendance',[UserController::class,'attendance'])->name('attendance');
        Route::get('classes',[UserController::class,'classes'])->name('classes')->middleware('payment.confirm');
        Route::get('dairy',[UserController::class,'dairy'])->name('dairy');
        Route::get('homework',[UserController::class,'homework'])->name('homework');
        Route::get('exam',[UserController::class,'exam'])->name('exam');
   
        Route::post('upload-task',[UserController::class,'upload_homework'])->name('upload_homework');
        Route::post('class-attendance',[UserController::class,'class_attendance'])->name('class_attendance');
        Route::post('upload-exam',[UserController::class,'upload_exam'])->name('upload_exam');
    
        Route::get('report-generate',[UserController::class,'report_generate'])->name('report_generate');

        Route::get('payment-receipt',[UserController::class,'payment_receipt'])->name('payment_receipt');
    });


