<?php
    namespace App\Http\Controllers\Student;
    use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;
    
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('profile', [UserController::class,'index'])->name('profile');
    Route::post('update-profile', [UserController::class,'updateProfile'])->name('updateProfile');
    Route::get('change-password', [UserController::class,'changePassword'])->name('changePassword');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('updatePassword');

    Route::get('classes',[UserController::class,'classes'])->name('classes');
    Route::get('dairy',[UserController::class,'dairy'])->name('dairy');
    Route::get('homework',[UserController::class,'homework'])->name('homework');
    Route::get('exam',[UserController::class,'exam'])->name('exam');
    Route::get('payment',[UserController::class,'payment'])->name('payment');
