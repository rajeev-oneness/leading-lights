<?php
    namespace App\Http\Controllers\Teacher;
    use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;
    
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('profile', [TeacherController::class,'index'])->name('profile');
    Route::post('update-profile', [TeacherController::class,'updateProfile'])->name('updateProfile');
    Route::get('change-password', [TeacherController::class,'changePassword'])->name('changePassword');
    Route::post('update-password', [TeacherController::class,'updatePassword'])->name('updatePassword');
    Route::get('home-task',[TeacherController::class,'homeTask'])->name('homeTask');
    Route::post('upload-home-task',[TeacherController::class,'uploadHomeTask'])->name('uploadHomeTask');
