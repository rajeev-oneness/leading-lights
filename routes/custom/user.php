<?php
    namespace App\Http\Controllers\Student;
    use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;
    
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('profile', [UserController::class,'index'])->name('profile');
    Route::post('update-profile', [UserController::class,'updateProfile'])->name('updateProfile');
    Route::get('change-password', [UserController::class,'changePassword'])->name('changePassword');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('updatePassword');
