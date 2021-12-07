<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Route;


// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Forgot / Reset Password --------------------------------->
// Route::any('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('forgotPassword');
// Route::post('/send-password-link', [ResetPasswordController::class, 'sendResetLink'])->name('sendResetLink');
// Route::any('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');
//<---------------------------------- Forgot / Reset Password

Route::group(['middleware' => ['auth', 'superAdmin']], function () {
    Route::resource('admin', SuperAdminController::class);
});
